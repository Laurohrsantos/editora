<?php

namespace CodeEduBook\Http\Controllers;

use CodePub\Criteria\FindByAuthorCriteria;
use CodePub\Criteria\FindByTitleCriteria;
use CodeEduBook\Models\Book;
use CodeEduBook\Http\Requests\BookRequest;
use CodeEduBook\Models\Category;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;

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
     */
    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {

        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
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
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param $id
     */
    public function show($id)
    {
        $categories = $this->categoryRepository->lists('name', 'id'); //pluck
        $book = $this->repository->find($id);
        return view('codeedubook::books.show', compact('book', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     */
    public function edit($id)
    {
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id'); //pluck
        $book = $this->repository->find($id);
        return view('codeedubook::books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Book $book
     * @internal param int $id
     */
    public function update(BookRequest $request, $id)
    {
        $data = $request->except(['author_id']);
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Livro alterado com Sucesso.');
        $url = $request->get('redirect_to', route('books.index'));

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
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
