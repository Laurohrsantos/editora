@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>


            {!! Form::model($book, [
                'route' => ['books.update', 'category' => $book->id],
                'class' => 'form', 'method' => 'PUT']) !!}

                @include('books._form')

            {!! Html::openFormGroup() !!}
                {!! Form::submit('Editar Livro', ['class' => 'btn btn-info']) !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection