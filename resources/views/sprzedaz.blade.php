@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Lista klientów</h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(count($klienci) > 0)
        <table class="table table-striped" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Miejscowość</th>
                    <th scope="col">Adres</th>
                    <th scope="col">Nr.tel</th>
                    <th scope="col">Dodano przez</th>
                    <th scope="col" class="text-center">Narzędzia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($klienci as $klient)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{$klient->nazwa}}
                        <span class="badge badge-pill badge-primary">
                            {{count($klient->zamowienia)}}
                        </span>
                    </td>
                    <td>{{$klient->miejscowosc}}</td>
                    <td>{{$klient->adres}}</td>
                    <td>{{$klient->tel}}</td>
                    <td>{{$klient->author->name}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{url('/sprzedaz/' . $klient->id)}}" class="btn btn-secondary btn-sm">                    
                            Pokaż
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Brak klientów w bazie</p>
        @endif
    </div>
@endsection