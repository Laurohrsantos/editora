@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lixeira de Livros</h3>
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
            @if($books->count() > 0)
            {!!
                Table::withContents($books->items())->striped()->callback('Ações', function ($field, $book) {
                    return "<ul class=\"list-inline\">".
                           "<li>".Button::link('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver')->asLinkTo(route('trashed.books.show', ['book' => $book->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $books->links()  }}

            @else
                <div class="well well-lg text-center">
                    <b>Lixeira vazia!</b>
                </div>
            @endif

        </div>
    </div>
@endsection