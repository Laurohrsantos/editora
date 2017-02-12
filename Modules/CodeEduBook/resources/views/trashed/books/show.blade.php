@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Livro deletado</h3>

            {!! Form::model($book, [
                'route' => ['trashed.books.update', 'book' => $book->id],
                'class' => 'form', 'method' => 'PUT']) !!}

            {!! Form::hidden('redirect_to', URL::previous()) !!}

            <fieldset readonly="readonly">
                <fieldset readonly="readonly">
                    <div class="form-group">
                        {!! Form::label('title', 'Título') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('subtitle', 'Subtítulo') !!}
                        {!! Form::text('subtitle', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('price', 'Preço') !!}
                        {!! Form::number('price', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('categories[]', 'Categorias', ['class' => 'control-label']) !!}
                        {!! Form::text('categories[]', $book->categories->implode('name_trashed', ', '), ['class' => 'form-control', 'multiple' => true, 'readonly' => 'readonly']) !!}
                    </div>
                </fieldset>
            </fieldset>

            <div class="form-group">
                {!! Form::submit('Recuperar Livro', ['class' => 'btn btn-warning']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection