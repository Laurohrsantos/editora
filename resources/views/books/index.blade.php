@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            <a href="{{ route('books.create')  }}" class="btn btn-primary  ">Novo Livro</a>
        </div>
        <br>
        <div class="row">
            {!!
                Table::withContents($books->items())->striped()->callback('Ações', function ($field, $book) {
                    return "<ul class=\"list-inline\">".
                           "<li>".Button::link('Editar')->asLinkTo(route('books.edit', ['category' => $book->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('Deletar')->asLinkTo(route('books.show', ['category' => $book->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $books->links()  }}

        </div>
    </div>
@endsection