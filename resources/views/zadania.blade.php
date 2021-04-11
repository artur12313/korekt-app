@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
        <h1>Lista zadań Pracownika: {{$rozliczenia->pracownik->imie}} {{$rozliczenia->pracownik->nazwisko}}</h1>
        <a href="{{url("/zadania/$rozliczenia->id/nowe")}}" class="btn btn-primary">Nowe zadanie</a>
    </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <table class="table table-striped" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Klient</th>
                    <th scope="col">Liczba godzin</th>
                    <th scope="col">Stawka</th>
                    <th scope="col">Autor</th>
                    <th scope="col" class="text-center">Narzędzia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rozliczenia->zadania as $zadanie)
            <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$zadanie->data}}</td>
            <td>{{$zadanie->opis}}</td>
            <td>{{$zadanie->client->nazwa}}</td>
            <td>{{$zadanie->pivot->czas}}</td>
            <td>{{$zadanie->pivot->stawka}}zł</td>
            <td>{{$zadanie->author->name}}</td>
                <td class="d-flex justify-content-center">
                        {!! Form::open(['action' =>['ZadaniaController@destroy', $zadanie->id], 'method' => 'DELETE']) !!}
               {{ Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2']) }}
               {!! Form::close() !!}
                   </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection