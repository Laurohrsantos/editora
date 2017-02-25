@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Configurações de perfil</h3>

            <div class="jumbotron">
                <div class="row">
                    <div class="col-xs-3 col-md-3">
                        <div class="thumbnail">
                            <img src="http://www.flottetippse.de/wp-content/uploads/2016/03/testimonial-kunde.png" alt="profile image">
                        </div>
                        <p><a class="btn btn-primary" href="#">Alterar foto</a></p>
                    </div>
                    <div class="col-xs-5 col-md-6">
                        <h3>Nome: <small>{{ $user->name }}</small></h3>
                        <h3>E-mail: <small>{{ $user->email }}</small></h3>
                    </div>
                    <div class="col-md-3">
                        <p><a class="btn btn-primary btn-lg" href="{{ route('codeeduuser.user_settings.edit') }}">Alterar senha</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection