@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Capítulos de: {{$book->title}}</h3>
            {!! Button::primary('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo capítulo')->asLinkTo(route('chapters.create', ['book' => $book->id])) !!}
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
                Table::withContents($chapters->items())->striped()->callback('Ações', function ($field, $chapter) use ($book) {
                    return "<ul class=\"list-inline\">".
                           "<li>".Button::link('<span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar')->asLinkTo(route('chapters.edit', ['book' => $book->id, 'chapter' => $chapter->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Lixeira')->asLinkTo(route('chapters.show', ['book' => $book->id, 'chapter' => $chapter->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $chapters->links()  }}

        </div>
    </div>
@endsection