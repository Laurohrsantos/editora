@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova Função</h3>

            {!! Form::open(['route' => 'codeeduuser.roles.store', 'class' => 'form']) !!}

                @include('codeeduuser::roles._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar Função', ['class' => 'btn btn-primary'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
       </div>
    </div>
@endsection