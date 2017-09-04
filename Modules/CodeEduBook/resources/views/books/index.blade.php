@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            <a href="{{ route('books.create')  }}" class="btn btn-primary  "><span
                        class="glyphicon glyphicon-plus"></span> Novo Livro</a>
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

                    $exportFormId = "export-form-{$book->id}";

                    return "<ul class=\"list-inline\">".
                           "<li>".Button::link('<span class="glyphicon glyphicon-book" aria-hidden="true"> Capítulos</span>')->asLinkTo(route('chapters.index', ['book' => $book->id]))."<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon glyphicon-picture" aria-hidden="true"> Cover</span>')->asLinkTo(route('books.cover.create', ['book' => $book->id]))."<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"> Editar</span>')->asLinkTo(route('books.edit', ['category' => $book->id]))."<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon-upload" aria-hidden="true" data-toggle="modal" data-target="#exportForm'."{$book->id}".'"> Exportar</span>')."<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon-trash text-danger" aria-hidden="true"> Lixeira</span>')->asLinkTo(route('books.show', ['category' => $book->id]))."<li>".
                           "</ul>".

                    "<div class='modal fade' id='exportForm".$book->id."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span
                                                aria-hidden='true'>&times;</span></button>
                                    <h4 class='modal-title' id='myModalLabel'>Exportar o livro: <b>".$book->title." <small>".$book->subtitle."</small></b></h4>
                                </div>
                                <div class='modal-body'>
                                    Este procedimento é feito para exportar os capítulos feitos que serão usados para gerar o conteúdo do livro. É recomendado usar quando o livro é finalizado.
                                </div>
                                <div class='modal-footer'>
                                    ".
                                    Form::open([
                                        'route' => ['books.export', 'book' => $book->id],
                                        'id' => $exportFormId, 'method' => 'POST']).
                                         Button::primary('Exportar Livro', ['class' => 'btn btn-info'])->prependIcon(Icon::ok())->submit();
                                    Form::close()
                                    ."
                                </div>
                            </div>
                        </div>
                    </div>";

                })
            !!}

            {{ $books->links()  }}

        </div>
    </div>
@endsection