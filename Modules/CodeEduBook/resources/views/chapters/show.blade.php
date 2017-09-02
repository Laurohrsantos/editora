@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Deletar capítulo - Livro: {{$book->title}}</h3>

            {!! Form::model($chapters, [
                'route' => ['chapters.destroy', 'book' => $book->id, 'chapters' => $chapters->id],
                'class' => 'form', 'method' => 'DELETE']) !!}

            {!! Form::hidden('redirect_to', URL::previous()) !!}

            <fieldset readonly="readonly">
                <fieldset readonly="readonly">
                    <div class="form-group">
                        {!! Form::label('name', 'Nome') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('order', 'Ordem') !!}
                        {!! Form::text('order', isset($chapters)?$chapters->order: 1, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('content', 'Conteúdo') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                </fieldset>
            </fieldset>

            <div class="form-group">
                {!! Button::danger('Deletar capítulo', ['class' => 'btn btn-danger'])->prependIcon(Icon::remove())->submit() !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection