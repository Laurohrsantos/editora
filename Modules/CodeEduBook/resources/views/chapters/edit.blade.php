@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar capítulo: {{$book->title}}</h3>


            {!! Form::model($chapter, [
                'route' => ['chapters.update', 'book' => $book->id, 'chapters' => $chapter->id],
                'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeedubook::chapters._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Editar capítulo', ['class' => 'btn btn-info'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection