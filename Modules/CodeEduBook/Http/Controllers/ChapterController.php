<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Criteria\FindByBook;
use CodeEduBook\Http\Requests\ChapterCreateRequest;
use CodeEduBook\Http\Requests\ChapterUpdateRequest;
use CodeEduBook\Repositories\ChapterRepository;
use CodeEduBook\Models\Book;
use CodeEduBook\Http\Requests\BookRequest;
use CodeEduBook\Repositories\BookRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="chapter-permission", description="Administração de Capítulos")
 */
class ChapterController extends Controller
{
    /**
     * @var ChapterRepository
     */
    private $repository;
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * BooksController constructor.
     * @param BookRepository|ChapterRepository $repository
     * @param BookRepository $bookRepository
     * @internal param CategoryRepository $categoryRepository
     */
    public function __construct(ChapterRepository $repository, BookRepository $bookRepository)
    {

        $this->repository = $repository;
        $this->bookRepository = $bookRepository;
        $this->repository->pushCriteria(new FindByAuthor());
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="list", description="Ver listagem de capítulos.")
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param $id
     */
    public function index(Request $request, Book $book)
    {
        $search = $request->get('search');
        $this->repository->pushCriteria(new FindByBook($book->id));
        $chapters = $this->repository->paginate(10);

        return view('codeedubook::chapters.index', compact('chapters', 'search', 'book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="store", description="Criação de capítulos.")
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('codeedubook::chapters.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="store", description="Criação de capítulos.")
     * @param BookRequest|ChapterCreateRequest|Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param $id
     */
    public function store(ChapterCreateRequest $request, Book $book)
    {
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->repository->create($data);
        $request->session()->flash('message', 'Capítulo cadastrado com Sucesso.');
        $url = $request->get('redirect_to', route('chapters.index', ['book' => $book->id]));

        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @Permission\Action(name="delete", description="Exclusão de caítulos.")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param $id
     */
    public function show(Book $book, $chapterID)
    {
        $chapter = $this->repository->find($chapterID);
//        $book = $this->repository->find($id);
        return view('codeedubook::chapters.show', compact('chapter', 'book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Edição de livros.")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     */
    public function edit(Book $book, $chapterID)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $chapter = $this->repository->find($chapterID);
        return view('codeedubook::chapters.edit', compact('chapter', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Edição de livros.")
     * @param ChapterUpdateRequest $request
     * @param Book $book
     * @param $chapterID
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $id
     * @internal param Book $book
     * @internal param int $id
     */
    public function update(ChapterUpdateRequest $request, Book $book, $chapterID)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $data = $request->except(['book_id']);
        $this->repository->update($data, $chapterID);
        $request->session()->flash('message', 'Capítulo alterado com Sucesso.');
        $url = $request->get('redirect_to', route('books.index', ['book' => $book->id]));

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
    public function destroy(BookRequest $request, $id) //o erro era que eu estava passando o request
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Livro deletado com Sucesso.');

        return redirect()->route('books.index');
    }
}
