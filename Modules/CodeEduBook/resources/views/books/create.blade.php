@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova Categoria</h3>

            {!! Form::open(['route' => 'books.store', 'class' => 'form']) !!}

            @include('codeedubook::books._form')

            {!! Html::openFormGroup() !!}
                {!! Form::submit('Criar Livro', ['class' => 'btn btn-primary']) !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
       </div>
    </div>
@endsection