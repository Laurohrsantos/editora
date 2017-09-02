@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Imagem de: {{$book->title}}</h3>

            {!! Form::open(['route' => ['books.cover.store', $book->id], 'files' => true, 'class' => 'form']) !!}

            {!! Form::hidden('redirect_to', URL::previous()) !!}

            {!! Html::openFormGroup('file', $errors) !!}
                {!! Form::label('file', 'Cover (Formato aceito: .jpg)') !!}
                {!! Form::file('file', ['class' => 'form-control']) !!}
                {!! Form::error('file', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Button::primary('Enviar', ['class' => 'btn btn-primary'])->prependIcon(Icon::ok())->submit() !!}

            {!! Form::close() !!}
       </div>
    </div>
@endsection