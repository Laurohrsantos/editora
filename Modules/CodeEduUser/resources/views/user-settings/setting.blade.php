@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Alterar senha</h3>

            {!! Form::open(['route' => 'codeeduuser.user_settings.update', 'class' => 'form', 'method' => 'PUT']) !!}

            {!! Html::openFormGroup('password', $errors) !!}
                {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                {!! Form::error('password', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup() !!}
                {!! Form::label('password_confirmation', 'Confirmar senha', ['class' => 'control-label']) !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar Usuário', ['class' => 'btn btn-primary'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection