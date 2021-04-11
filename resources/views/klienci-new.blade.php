@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 offset-md-3">
            <h1>Nowy klient</h1>
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
            {!! Form::open(['action' => 'KlientController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('nazwa', 'Nazwa')}}
                {{Form::text('nazwa', '', ['class' => 'form-control', 'placeholder' => 'Tłocznia Margaryny SA'])}}
            </div>
            <div class="form-group">
                {{Form::label('miejscowosc', 'Miejscowość')}}
                {{Form::text('miejscowosc', '', ['class' => 'form-control', 'placeholder' => 'Wałbrzych'])}}
            </div>
            <div class="form-group">
                {{Form::label('adres', 'Adres')}}
                {{Form::text('adres', '', ['class' => 'form-control', 'placeholder' => 'Szkolna 15'])}}
            </div>
            <div class="form-group">
                {{Form::label('tel', 'Telefon')}}
                {{Form::text('tel', '', ['class' => 'form-control', 'placeholder' => '600300100'])}}
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                {{Form::submit('Wyślij', ['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection