@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Categoria</h3>


            {!! Form::model($category, [
                'route' => ['categories.update', 'category' => $category->id],
                'class' => 'form', 'method' => 'PUT']) !!}

            {!! Html::openFormGroup('name', $errors) !!}
                {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! Form::error('name', $errors) !!}
                {{-- $errors->first('name') --}}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup() !!}
                {!! Form::submit('Editar Categoria', ['class' => 'btn btn-info']) !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection