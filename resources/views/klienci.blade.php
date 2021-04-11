@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Lista klientów</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#klient">Nowy klient</button>
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
                        <a href="{{url('/klienci/' . $klient->id)}}" class="btn btn-secondary btn-sm">                    
                            Pokaż
                        </a>
                        <a href="{{url("/klienci/$klient->id/edit")}}" class="btn btn-primary btn-sm ml-2">Edytuj</a>
                        {!! Form::open(['action' => ['KlientController@destroy', $klient->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                        {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                    {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Brak klientów w bazie</p>
        @endif
        <!-- Modal -->
<div class="modal fade" id="klient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Nowy klient</h5>
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
        {!! Form::open(['action' => 'KlientController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('nazwa', 'Nazwa')}}
            {{Form::text('nazwa', '', ['class' => 'form-control', 'placeholder' => 'Tłocznia Margaryny SA'])}}
        </div>
        <div class="form-group">
            {{Form::label('miejscowosc', 'Miejscowość')}}
            {{Form::text('miejscowosc', '', ['class' => 'form-control', 'placeholder' => 'Wałbrzych'])}}
        </div>
        <div class="form-group">
            {{Form::label('adres', 'Adres')}}
            {{Form::text('adres', '', ['class' => 'form-control', 'placeholder' => 'Szkolna 15'])}}
        </div>
        <div class="form-group">
            {{Form::label('tel', 'Telefon')}}
            {{Form::text('tel', '', ['class' => 'form-control', 'placeholder' => '600300100'])}}
        </div>
        <div class="form-group">
            {{Form::label('dotyczy', 'Dotyczy')}}
            {{Form::text('dotyczy', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('zakres', 'Zakres')}}
            {{Form::text('zakres', '', ['class' => 'form-control', 'placeholder' => 'Zakres'])}}
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
    </div>
@endsection