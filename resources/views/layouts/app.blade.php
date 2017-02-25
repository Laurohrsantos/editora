<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <?php
            $navbar =  Navbar::withBrand(config('app.name'), url('/'))->inverse();
            if(Auth::check()) {
                $links = Navigation::links([
                    [
                        'link' => route('categories.index'),
                        'title' => 'Categorias'
                    ],
                    [
                        'Livros',
                        [
                            [
                                'link' => route('books.index'),
                                'title' => 'Listar'
                            ],
                            [
                                'link' => route('trashed.books.index'),
                                'title' => 'Lixeira'
                            ],
                        ]
                    ],
                    [
                        'link' => route('codeeduuser.users.index'),
                        'title' => 'Usuários'
                    ],
                    [
                        'link' => route('codeeduuser.roles.index'),
                        'title' => 'Funções'
                    ]
                ]);
                $logout = Navigation::links([
                    [
                        Auth::user()->name,
                        [
                            [
                                'link' => route('codeeduuser.user_settings.profile'),
                                'title' => '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Perfil'
                            ],
                            [
                                'link' => url('/logout'),
                                'title' => '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout',
                                'linkAttributes' => [
                                    'onclick' => "event.preventDefault(); document.getElementById(\"logout-form\").submit();"
                                ]
                            ]
                        ]
                    ]
                ])->right();
                $navbar->withContent($links)->withContent($logout);
            }
        ?>

        {!! $navbar !!}
        {!! Form::open([ 'url' => url('/logout'), 'id' => 'logout-form', 'style' => 'display: none']) !!}
        {!! Form::close() !!}

        @if(Session::has('message'))
            <div class="container">
                {!! Alert::success(Session::get('message'))->close() !!}
            </div>s
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
