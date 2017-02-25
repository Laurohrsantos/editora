@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>


            {!! Form::model($book, [
                'route' => ['books.update', 'category' => $book->id],
                'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeedubook::books._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Editar Livro', ['class' => 'btn btn-info'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection