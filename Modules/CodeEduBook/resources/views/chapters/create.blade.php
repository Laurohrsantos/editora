@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Capítulo - Livro: {{$book->title}}</h3>

            {!! Form::open(['route' => ['chapters.store', 'book' => $book->id], 'class' => 'form']) !!}

            @include('codeedubook::chapters._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar capítulo', ['class' => 'btn btn-primary'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
       </div>
    </div>
@endsection