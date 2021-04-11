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
        {!! Form::open(['action' => ['PdfController@pdf', $klient->id], 'method' => 'GET']) !!}
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
    <hr class="mt-5">
        <div class="mt-5">
        <h1>Podsumowanie zamówień klienta (statystyki)</h1>
        <div class="row no-gutters">
            <div class="col-12 col-sm-6 py-5 px-2">
                <div class="shadow-lg text-center p-3 rounded" style="border-bottom: 5px solid #1E88E5">
                    <h1 class="display-5">
                        <span
                        style="background-color: #1E88E5; color:white"
                        class="badge p-3 px-4 shadow">
                            {{count($klient->zamowienia)}}
                        </span>
                    </h1>
                    <hr>
                    <p class="lead text-muted">Ilość <br>Zamówień</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 py-5 px-2">
                <div class="shadow-lg text-center p-3 rounded" style="border-bottom: 5px solid #3949AB">
                    <h1 class="display-5">
                        <span
                        style="background-color: #3949AB; color:white;"
                        class="badge p-3 px-4 shadow">
                            {{$klient->razem_wartosc_sprzedazy}} zł
                        </span>
                    </h1>
                    <hr>
                    <p class="lead text-muted">
                        Suma
                        <br>
                        <br>
                    </p>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection