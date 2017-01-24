@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            <a href="{{ route('categories.create')  }}" class="btn btn-primary  ">Nova Categoria</a>
        </div>
        <br>
        <div class="row">
            {!!
                Table::withContents($categories->items())->striped()->callback('Ações', function ($field, $category) {
                    return "<ul class=\"list-inline\">".
                           "<li>".Button::link('Editar')->asLinkTo(route('categories.edit', ['category' => $category->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('Deletar')->asLinkTo(route('categories.show', ['category' => $category->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $categories->links()  }}

        </div>
    </div>
@endsection