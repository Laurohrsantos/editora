@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Usuário</h3>

            {!! Form::open(['route' => 'codeeduuser.users.store', 'class' => 'form']) !!}

                @include('codeeduuser::users._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar Usuário', ['class' => 'btn btn-primary'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
       </div>
    </div>
@endsection