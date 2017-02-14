<?php

namespace CodeEduBook\Http\Controllers;

use CodePub\Criteria\FindOnlyTrashedCriteria;
use CodeEduBook\Models\Book;
use CodeEduBook\Repositories\BookRepository;
use Illuminate\Http\Request;

class BooksTrashedController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BooksController constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository)
    {

        $this->repository = $repository;
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
        $books = $this->repository->onlyTrashed()->paginate(10);

        return view('codeedubook::trashed.books.index', compact('books', 'search'));
    }

    public function show($id)
    {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);

        return view('codeedubook::trashed.books.show', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $request->session()->flash('message', 'Livro restaurado com Sucesso.');
        $url = $request->get('redirect_to', route('trashed.books.index'));

        return redirect()->to($url);
    }

}
