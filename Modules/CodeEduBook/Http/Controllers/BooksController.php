<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Http\Requests\BookCoverRequest;
use CodeEduBook\Pub\BookCoverUpload;
use CodeEduBook\Pub\BookExport;
use CodePub\Criteria\FindByAuthorCriteria;
use CodePub\Criteria\FindByTitleCriteria;
use CodeEduBook\Models\Book;
use CodeEduBook\Http\Requests\BookRequest;
use CodeEduBook\Models\Category;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="books-permission", description="Administração de livros")
 */
class BooksController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * BooksController constructor.
     * @param BookRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {

        $this->repository = $repository;
        $this->repository->pushCriteria(new FindByAuthor());
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="list", description="Ver listagem de livros.")
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->paginate(10);

        return view('codeedubook::books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="store", description="Criação de livros.")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id'); //pluck
        return view('codeedubook::books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="store", description="Criação de livros.")
     * @param BookRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
//        dd($request->all());
        $data = $request->all();
        $data['author_id'] = \Auth::id();
        $this->repository->create($data);
        $request->session()->flash('message', 'Livro cadastrado com Sucesso.');
        $url = $request->get('redirect_to', route('books.index'));

        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @Permission\Action(name="delete", description="Exclusão de livros.")
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param $id
     * @internal param Book $book
     * @internal param $id
     */
    public function show(Book $book)
    {
        $categories = $this->categoryRepository->lists('name', 'id'); //pluck
        $book = $this->repository->find($book->id);
        return view('codeedubook::books.show', compact('book', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Edição de livros.")
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param $id
     * @internal param Book $book
     */
    public function edit(Book $book)
    {
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id'); //pluck
        $book = $this->repository->find($book->id);
        return view('codeedubook::books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Edição de livros.")
     * @param BookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $id
     * @internal param Book $book
     * @internal param int $id
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->except(['author_id']);
        $data['published'] = $request->get('published', false);
        $this->repository->update($data, $book->id);
        $request->session()->flash('message', 'Livro alterado com Sucesso.');
        $url = $request->get('redirect_to', route('books.index'));

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="delete", description="Exclusão de livros.")
     * @param BookRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param int $id
     */
    public function destroy(BookRequest $request, Book $book) //o erro era que eu estava passando o request
    {
        $this->repository->delete($book->id);
        \Session::flash('message', 'Livro deletado com Sucesso.');

        return redirect()->route('books.index');
    }


    /**
     * @Permission\Action(name="cover", description="Cover de livro")
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function coverForm (Book $book)
    {
        return view('codeedubook::books.cover', compact('book'));
    }

    /**
     * @Permission\Action(name="cover", description="Cover de livro")
     * @param BookCoverRequest $request
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function coverStore (BookCoverRequest $request, Book $book, BookCoverUpload $upload)
    {
        $upload->upload($book, $request->file('file'));
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'A imagem do cover foi adicionado com sucesso.');

        return redirect()->to($url);
    }

    public function export(Book $book)
    {
        $bookExport = app(BookExport::class);
        $bookExport->export($book);

        return redirect()->route('books.index');
    }
}
