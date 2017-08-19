@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            <a href="{{ route('books.create')  }}" class="btn btn-primary  "><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Livro</a>
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET']) !!}
                {!! Form::label('search', 'Pesquisar:', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control']) !!}

                {!! Button::primary('<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>

        <div class="row">
            {!!
                Table::withContents($books->items())->striped()->callback('Ações', function ($field, $book) {
                    return "<ul class=\"list-inline\">".
                           "<li>".Button::link('<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Capítulos')->asLinkTo(route('chapters.index', ['book' => $book->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar')->asLinkTo(route('books.edit', ['category' => $book->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Lixeira')->asLinkTo(route('books.show', ['category' => $book->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $books->links()  }}

        </div>
    </div>
@endsection