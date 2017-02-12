@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            <a href="{{ route('categories.create')  }}" class="btn btn-primary  "><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Categoria</a>
        </div>
        <br>
        <div class="row">
            {!!
                Table::withContents($categories->items())->striped()->callback('Ações', function ($field, $category) {
                    return "<ul class=\"list-inline\">".
                           "<li>".Button::LINK('<span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar')->asLinkTo(route('categories.edit', ['category' => $category->id]))."<li>".
                           "<li>|<li>".
                           "<li>".Button::link('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Deletar')->asLinkTo(route('categories.show', ['category' => $category->id]))."<li>".
                           "</ul>";
                })
            !!}

            {{ $categories->links()  }}

        </div>
    </div>
@endsection