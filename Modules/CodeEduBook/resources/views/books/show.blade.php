@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Deletar livro</h3>

            {!! Form::model($book, [
                'route' => ['books.destroy', 'category' => $book->id],
                'class' => 'form', 'method' => 'DELETE']) !!}

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
                        {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => true, 'readonly' => 'readonly']) !!}
                        {!! Form::error('categories', $errors) !!}
                        {!! Form::error('categories.*', $errors) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('dedication', 'Dedicatória', ['class' => 'control-label']) !!}
                        {!! Form::textarea('dedication', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Descrição', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('website', 'Website', ['class' => 'control-label']) !!}
                        {!! Form::text('website', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('percent_complete', 'Concluido (%)', ['class' => 'control-label']) !!}
                        {!! Form::number('percent_complete', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                </fieldset>
            </fieldset>

            <div class="form-group">
                {!! Button::danger('Deletar Livro', ['class' => 'btn btn-danger'])->prependIcon(Icon::remove())->submit() !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection