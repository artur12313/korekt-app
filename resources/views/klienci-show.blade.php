@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
                <h1>Klient {{$klient->nazwa}}</h1>
                <a href="{{url('zamowienia/nowe')}}" class="btn btn-primary">Nowe Zamówienie</a>
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
                <th scope="col">Klient</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Ilość produktów</th>
                <th scope="col">Data utworzenia</th>
                <th scope="col">Data zmodyfikowania</th>
                <th scope="col">Autor zamówienia</th>
                <th scope="col">VAT</th>
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
                <td>{{$zamowienie->created_ago}}</td>
                <td>{{$zamowienie->updated_ago}}</td>
                <td>{{$zamowienie->author->name}}</td>
                <td>{{$zamowienie->vat}} %</td>
                <td class="d-flex justify-content-center">
                    <a 
                    href="{{url("zamowienia/$zamowienie->id")}}" 
                    class="btn btn-secondary btn-sm ml-2">Pokaż</a>
                    {!! Form::open(['action' => ['ZamowienieController@destroy', $zamowienie->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                        {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr class="mt-5">
    <div class="mt-5">
        <h1>Podsumowanie zamówień klienta (statystyki)</h1>
        <div class="row no-gutters">
            <div class="col-12 col-sm-4 py-5 px-2">
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
            <div class="col-12 col-sm-4 py-5 px-2">
                <div class="shadow-lg text-center p-3 rounded" style="border-bottom: 5px solid #5E35B1">
                    <h1 class="display-5">
                        <span
                        style="background-color: #5E35B1; color:white"
                        class="badge p-3 px-4 shadow">
                            {{$klient->razem_wartosc_zakupu}} zł
                        </span>
                    </h1>
                    <hr>
                    <p class="lead text-muted">
                        Suma<br>
                        Wartości Zakupu
                    </p>
                </div>
            </div>
            <div class="col-12 col-sm-4 py-5 px-2">
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
                        Suma<br>
                        Wartości Sprzedaży
                    </p>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection