@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 offset-md-3">
            <h1>Edytuj kategorię</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <hr>
            @if($category)
            {!! Form::open(['action' => ['CategoryController@update', $category->id], 'method' => 'PUT']) !!}
            <div class="form-group">
                {{Form::label('name', 'Nazwa kategorii')}}
                {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Nazwa...'])}}
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                {{Form::submit('Wyślij', ['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>
@endsection