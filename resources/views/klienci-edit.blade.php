@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 offset-md-3">
            <h1>Edytuj klienta</h1>
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
            {!! Form::open(['action' => ['KlientController@update', $klient->id], 'method' => 'PUT']) !!}
            <div class="form-group">
                {{Form::label('nazwa', 'Nazwa')}}
                {{Form::text('nazwa', $klient->nazwa, ['class' => 'form-control', 'placeholder' => 'Tłocznia Margaryny SA'])}}
            </div>
            <div class="form-group">
                {{Form::label('miejscowosc', 'Miejscowość')}}
                {{Form::text('miejscowosc', $klient->miejscowosc, ['class' => 'form-control', 'placeholder' => 'Wałbrzych'])}}
            </div>
            <div class="form-group">
                {{Form::label('adres', 'Adres')}}
                {{Form::text('adres', $klient->adres, ['class' => 'form-control', 'placeholder' => 'Szkolna 15'])}}
            </div>
            <div class="form-group">
                {{Form::label('tel', 'Telefon')}}
                {{Form::text('tel', $klient->tel, ['class' => 'form-control', 'placeholder' => '600300100'])}}
            </div>
            <div class="form-group">
                {{Form::label('dotyczy', 'Dotyczy')}}
                {{Form::text('dotyczy', $klient->dotyczy, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('zakres', 'Zakres')}}
                {{Form::text('zakres', $klient->zakres, ['class' => 'form-control', 'placeholder' => 'Zakres'])}}
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