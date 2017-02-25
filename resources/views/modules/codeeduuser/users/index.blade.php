@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Usuário</h3>
            <a href="{{ route('codeeduuser.users.create')  }}" class="btn btn-primary  "><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Usuário</a>
        </div>
        <br>
        <div class="row">
            {!!
                Table::withContents($users->items())->striped()->callback('Ações', function ($field, $user) {

                    return "<ul class=\"list-inline\">".
                           "<li>".Button::LINK('<span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar')->asLinkTo(route('codeeduuser.users.edit', ['user' => $user->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Deletar')->asLinkTo(route('codeeduuser.users.show', ['user' => $user->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $users->links()  }}

        </div>
    </div>
@endsection