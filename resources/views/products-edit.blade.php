@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 offset-md-3">
            <h1>Edycja produktu</h1>
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
            {!! Form::open(['action' => ['ProduktController@update', $produkt->id], 'method' => 'PUT']) !!}
            <div class="form-group">
                {{Form::label('nazwa', 'Nazwa produktu')}}
                {{Form::text('nazwa', $produkt->nazwa, ['class' => 'form-control', 'placeholder' => 'Nazwa...'])}}
            </div>
            <div class="form-group">
                {{Form::label('category_id', 'Kategoria')}}
                <select name="category_id" class="form-control">
                    @foreach($kategorie as $kategoria)
                        <option value="{{$kategoria->id}}"
                            @if($produkt->category && $kategoria->id == $produkt->category->id)
                            selected="selected"
                            @endif
                            >{{$kategoria->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{Form::label('jednostka', 'Jednostka')}}
                <select name="jednostka" class="form-control">
                        <option value="szt.">szt.</option>
                        <option value="m.b.">m.b.</option>
                        <option value="kpl.">kpl.</option>
                        <option value="Kg.">Kg.</option>
                        <option value="opak.">opak.</option>
                </select>
            </div>
            <div class="form-group">
                {{Form::label('cena_zakupu_netto', 'Cena')}}
                {{Form::text('cena_zakupu_netto', $produkt->comma_price, ['class' => 'form-control', 'placeholder' => 'Cena'])}}
            </div>
            <div class="form-group">
                {{Form::label('dostawca', 'Dostawca')}}
                {{Form::text('dostawca', $produkt->dostawca, ['class' => 'form-control', 'placeholder' => 'Dostawca'])}}
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