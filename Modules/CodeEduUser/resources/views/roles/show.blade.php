@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Deletar Função</h3>

            {!! Form::model($role, [
                'route' => ['codeeduuser.roles.destroy', 'user' => $role->id],
                'class' => 'form', 'method' => 'DELETE']) !!}

            <fieldset disabled>
                <div class="form-group">
                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Descrição') !!}
                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                </div>
            </fieldset>

            <div class="form-group">
                <?php
                $button = $role->name == 'Admin' ?
                    Button::danger('Não é possível excluir a função de administrador', ['class' => 'btn btn-danger'])->prependIcon(Icon::remove())->submit()->disabled() : //eu modifiquei o bootstraper e inclui essa função disabled para poder usar.
                    Button::danger('Deletar função', ['class' => 'btn btn-danger'])->prependIcon(Icon::remove())->submit();
                ?>
                {!! $button !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection