@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
                <h1> Okres rozliczeniowy Pracownika: {{$pracownik->imie}} {{$pracownik->nazwisko}}</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#klient">Nowy Okres</button>
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
                <th scope="col">Opis</th>
                <th scope="col">Wynarodzenie</th>
                <th scope="col">Liczba godzin</th>
                <th scope="col">Narzędzia</th>
            </tr>
            </thead>
            <tbody>
                @foreach($pracownik->rozliczenia as $rozliczenie)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$rozliczenie->opis}}</td>
                <td>{{$rozliczenie->wynagrodzenie}} zł</td>
                <td>{{$rozliczenie->suma_godzin_pracy}}</td>
                            <td class="d-flex justify-content-center">
                             <a href="{{url("zadania/$rozliczenie->id")}}" class="btn btn-secondary btn-sm">                    
                                Pokaż
                             </a>
                             {!! Form::open(['action' => ['RozliczeniaController@destroy', $rozliczenie->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                    {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                    {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
     <!-- Modal -->
<div class="modal fade" id="klient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Nowy okres</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
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
            {!! Form::open(['action' => 'RozliczeniaController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('opis', 'Opis')}}
                {{Form::text('opis', '', ['class' => 'form-control'])}}
                <input type="hidden" value="{{$pracownik->id}}" name="pracownik_id"/>
            </div>
            <hr>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
              <div class="d-flex justify-content-end">
                {{Form::submit('Zapisz', ['class'=>'btn btn-primary'])}}
            </div>
                {!! Form::close() !!}
            </div>
            </div>
          </div>
        </div>
      </div>
@endsection