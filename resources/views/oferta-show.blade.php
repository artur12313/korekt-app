@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
                <h1>Klient {{$klient->nazwa}}</h1>
            </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        {!! Form::open(['action' => ['PdfController@oferta', $klient->id], 'method' => 'GET']) !!}
    <table class="table table-striped" id="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Klient</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Ilość produktów</th>
                <th scope="col">Wliczone do zamówienia</th>
                <th scope="col">Data utworzenia</th>
                <th scope="col">Data zmodyfikowania</th>
                <th scope="col">Autor zamówienia</th>
                <th scope="col" class="text-center">Narzędzia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($klient->zamowienia->sortByDesc('updated_at') as $zamowienie)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$zamowienie->client->nazwa}}</td>
                <td>{{$zamowienie->nazwa}}</td>
                <td>
                    <span class="badge badge-pill badge-primary">
                        {{count($zamowienie->products)}}
                    </span>
                </td>

            <td>{!!Form::checkbox('zamowienie[]', $zamowienie->id,'checked')!!}</td>
                <td>{{$zamowienie->created_ago}}</td>
                <td>{{$zamowienie->updated_ago}}</td>
                <td>{{$zamowienie->author->name}}</td>
                <td class="d-flex justify-content-center">
                    <a 
                    href="{{url("zamowienie/$zamowienie->id")}}" 
                    class="btn btn-secondary btn-sm ml-2">Pokaż</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        <div class="nav justify-content-center">
            {{Form::submit('Podsumuj', ['class'=>'btn btn-success btn-lg btn-block'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection