@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Deletar Categoria</h3>

            {!! Form::model($category, [
                'route' => ['categories.destroy', 'category' => $category->id],
                'class' => 'form', 'method' => 'DELETE']) !!}

            <fieldset disabled>
                <div class="form-group">
                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </fieldset>

            <div class="form-group">
                {!! Button::danger('Deletar Categoria', ['class' => 'btn btn-danger'])->prependIcon(Icon::remove())->submit() !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection