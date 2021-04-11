@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Lista zamówień</h1>
            <a href="{{url('/zamowienia/nowe')}}" class="btn btn-primary">Nowe zamówienie</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(count($zamowienia) > 0)
        <table class="table table-striped" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Klient</th>
                    <th scope="col">Ilość produktów</th>
                    <th scope="col">Data utworzenia</th>
                    <th scope="col">Data zmodyfikowania</th>
                    <th scope="col">Autor zamówienia</th>
                    <th scope="col">VAT</th>
                    <th scope="col" class="text-center">Narzędzia</th>
                </tr>
            </thead>
            <tbody>
            @foreach($zamowienia as $zamowienie)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$zamowienie->nazwa}}</td>
                    <td>{{$zamowienie->client->nazwa}}</td>
                    <td>
                        <span class="badge badge-pill badge-primary">
                            {{count($zamowienie->products)}}
                        </span>
                    </td>
                    <td>{{$zamowienie->created_ago}}</td>
                    <td>{{$zamowienie->updated_ago}}</td>
                    <td>{{$zamowienie->author->name}}</td>
                    <td>{{$zamowienie->vat}}%</td>
                    <td class="d-flex justify-content-center">
                    <a href="{{url("/zamowienia/$zamowienie->id")}}" class="btn btn-secondary btn-sm">Pokaż</a>
                    {!! Form::open(['action' => ['ZamowienieController@destroy', $zamowienie->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                    {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach           
        </tbody>
    </table>
    @else
    <p>Brak zamówień do wyświetlenia</p>
    @endif
    </div>
@endsection