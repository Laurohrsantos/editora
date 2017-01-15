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
                                <ul class="list-inline">
                                    <li><a href="{{ route('categories.edit', ['category' => $category->id]) }}">Editar</a></li>
                                    <li>|</li>
                                    <li>
                                        <a href="{{ route('categories.show', ['category' => $category->id]) }}">Deletar</a>
                                        {{--<?php $deleteForm = "delete-form-{$loop->index}"; ?>--}}
                                        {{--<a href="{{ route('categories.destroy', ['category' => $category->id]) }}"--}}
                                        {{--onclick="event.preventDefault(); document.getElementById('{{ $deleteForm  }}').submit">Deletar</a>--}}
                                        {{--{!! Form::open(['route' => ['categories.destroy', 'category' => $category->id], 'id' => $deleteForm, 'method' => 'DELETE']) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </li>
                                </ul>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $categories->links()  }}

        </div>
    </div>
@endsection