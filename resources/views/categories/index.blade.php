@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            <a href="{{ route('categories.create')  }}" class="btn btn-primary  ">Nova Categoria</a>
        </div>
        <br>
        <div class="row">
            <table class="table table-striped">
                <tread>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </tread>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a><i class="glyphicon glyphicon-edit" aria-hidden="true">Editar</i></a>
                                <a><i class="glyphicon glyphicon-remove" aria-hidden="true">Deletar</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $categories->links()  }}

        </div>
    </div>
@endsection