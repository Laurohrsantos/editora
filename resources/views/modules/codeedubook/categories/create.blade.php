@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova Categoria</h3>

            {!! Form::open(['route' => 'categories.store', 'class' => 'form']) !!}

                @include('codeedubook::categories._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar Categoria', ['class' => 'btn btn-primary'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
       </div>
    </div>
@endsection