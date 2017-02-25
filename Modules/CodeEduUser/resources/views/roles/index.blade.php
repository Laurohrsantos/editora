@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Funções</h3>
            <a href="{{ route('codeeduuser.roles.create')  }}" class="btn btn-primary  "><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Função</a>
        </div>
        <br>
        <div class="row">
            {!!
                Table::withContents($roles->items())->striped()->callback('Ações', function ($field, $role) {

                    return "<ul class=\"list-inline\">".
                           "<li>".Button::LINK('<span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar')->asLinkTo(route('codeeduuser.roles.edit', ['user' => $role->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Deletar')->asLinkTo(route('codeeduuser.roles.show', ['user' => $role->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $roles->links()  }}

        </div>
    </div>
@endsection