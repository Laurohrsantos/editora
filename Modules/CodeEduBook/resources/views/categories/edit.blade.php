@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Categoria</h3>


            {!! Form::model($category, [
                'route' => ['categories.update', 'category' => $category->id],
                'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeedubook::categories._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Editar Categoria', ['class' => 'btn btn-info'])->prependIcon(Icon::ok())->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection