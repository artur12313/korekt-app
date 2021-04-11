@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 offset-md-3">
            <h1>Nowy produkt</h1>
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
            {!! Form::open(['action' => 'ProduktController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('nazwa', 'Nazwa produktu')}}
                {{Form::text('nazwa', '', ['class' => 'form-control', 'placeholder' => 'Nazwa...'])}}
            </div>
            <div class="form-group">
                {{Form::label('category_id', 'Kategoria')}}
                <select name="category_id" class="form-control">
                    @foreach($kategorie as $kategoria)
                        @if($selectedCategoryId == $kategoria->id)
                            <option value={{$kategoria->id}} selected>{{$kategoria->name}}</option>
                        @else
                            <option value={{$kategoria->id}}>{{$kategoria->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <input type="hidden" value={{$selectedCategoryId}} name="selectedCategoryId"/>
            <div class="form-group">
                {{Form::label('jednostka', 'Jednostka')}}
                <select name="jednostka" class="form-control">
                    <option value="szt.">szt.</option>
                    <option value="m.b.">mb.</option>
                    <option value="kpl.">kpl.</option>
                    <option value="Kg.">Kg.</option>
                    <option value="opak.">opak.</option>
            </select>
            </div>
            <div class="form-group">
                {{Form::label('cena_zakupu_netto', 'Cena')}}
                {{Form::text('cena_zakupu_netto', '', ['class' => 'form-control', 'placeholder' => 'Cena'])}}
            </div>
            <div class="form-group">
                {{Form::label('dostawca', 'Dostawca')}}
                {{Form::text('dostawca', '', ['class' => 'form-control', 'placeholder' => 'Dostawca'])}}
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