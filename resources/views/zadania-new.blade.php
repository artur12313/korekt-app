@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 offset-md-3">
            <h1>Nowe Zadanie</h1>
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
            {!! Form::open(['action' => ['ZadaniaController@store', $rozliczenia->id], 'method' => 'POST']) !!}
            <div class="form-group">
                    {{Form::label('opis', 'Opis')}}
                    {{Form::text('opis', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                        {{Form::label('data', 'Data')}}
                        {{Form::date('data', '', ['class' => 'form-control'])}}
                    </div>
                <div class="form-group">
                    {{Form::label('klient', 'Klient')}}
                    <select name="klient" class="form-control">
                            @foreach($klienci as $klient)
                                    <option value={{$klient->id}}>{{$klient->nazwa}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    {{Form::label('stawka', 'Stawka')}}
                    {{Form::text('stawka', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('czas', 'Liczba godzin')}}
                    {{Form::text('czas', '', ['class' => 'form-control'])}}
                </div>
                <hr>
                <div class="form-group">
                    {{Form::submit('Zapisz', ['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                  </div>
        </div>
    </div>
</div>
@endsection