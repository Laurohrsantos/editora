@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Deletar Usuário</h3>

            {!! Form::model($user, [
                'route' => ['codeeduuser.users.destroy', 'user' => $user->id],
                'class' => 'form', 'method' => 'DELETE']) !!}

            <fieldset disabled>
                <div class="form-group">
                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
            </fieldset>

            <div class="form-group">
                <?php
                $button = $user->id == \Auth::id() ?
                    Button::danger('Não é possível excluir o próprio usuário', ['class' => 'btn btn-danger'])->prependIcon(Icon::remove())->submit()->disabled() : //eu modifiquei o bootstraper e inclui essa função disabled para poder usar.
                    Button::danger('Deletar Usuario', ['class' => 'btn btn-danger'])->prependIcon(Icon::remove())->submit();
                ?>
                {!! $button !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection