@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Deletar Categoria</h3>

            {!! Form::model($books, [
                'route' => ['books.destroy', 'category' => $books->id],
                'class' => 'form', 'method' => 'DELETE']) !!}

            <fieldset disabled>
                <fieldset disabled>
                    <div class="form-group">
                        {!! Form::label('title', 'Título') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('subtitle', 'Subtítulo') !!}
                        {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('price', 'Preço') !!}
                        {!! Form::number('price', null, ['class' => 'form-control']) !!}
                    </div>
                </fieldset>
            </fieldset>

            <div class="form-group">
                {!! Form::submit('Deletar Categoria', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection