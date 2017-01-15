@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Deletar Categoria</h3>

            @inclue('errors._errors_form')
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
                {!! Form::submit('Deletar Categoria', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection