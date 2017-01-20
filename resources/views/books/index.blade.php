@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            <a href="{{ route('books.create')  }}" class="btn btn-primary  ">Novo Livro</a>
        </div>
        <br>
        <div class="row">
            <table class="table table-striped">
                <tread>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Subtítulo</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </tread>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->subtitle }}</td>
                        <td>{{ $book->price }}</td>
                        <td>
                            <ul class="list-inline">
                                <li><a href="{{ route('books.edit', ['category' => $book->id]) }}">Editar</a></li>
                                <li>|</li>
                                <li><a href="{{ route('books.show', ['category' => $book->id]) }}">Deletar</a></li>
                            </ul>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $books->links()  }}

        </div>
    </div>
@endsection