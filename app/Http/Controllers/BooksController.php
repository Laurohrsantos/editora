<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::query()->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        Book::create($request->all());
        $request->session()->flash('message', 'Livro cadastrado com Sucesso.');
        $url = $request->get('redirect_to', route('books.index'));

        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $books
     * @internal param int $id
     */
    public function show($id)
    {
        $books = Book::find($id);

        return view('books.show', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param Request $request
     * @internal param int $id
     */
    public function edit(Book $id)
    {
        $book = Book::find($id);
        return redirect()->route('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest|Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->fill($request->all());
        $book->save();
        $request->session()->flash('message', 'Livro alterado com Sucesso.');
        $url = $request->get('redirect_to', route('books.index'));

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Book $book)
    {
        $book->delete();
        \Session::flash('message', 'Livro deletado com Sucesso.');

        return redirect()->route('books.index');
    }
}
