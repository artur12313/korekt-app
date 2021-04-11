@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Lista Pracowników</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pracownik">Nowy pracownik</button>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    @if(count($pracownicy) > 0)
    <table class="table table-striped" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">telefon</th>
                    <th scope="col" class="text-center">Narzędzia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pracownicy as $pracownik)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pracownik->imie}}</td>
                    <td>{{$pracownik->nazwisko}}</td>
                    <td>{{$pracownik->tel}}</td>
                        <td class="d-flex justify-content-center">
                                <a href="{{url("/rozliczenia/$pracownik->id")}}" class="btn btn-secondary btn-sm">                    
                                    Pokaż
                                </a>
                                <a href="{{url("/pracownicy/$pracownik->id/edit")}}" class="btn btn-primary btn-sm ml-2">Edytuj</a>
                        {!! Form::open(['action' => ['PracownicyController@destroy', $pracownik->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                        {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                            {!! Form::close() !!}
                            </td>
                </tr>
                @endforeach
            </tbody>
    </table>
    @else
    <p>Brak Pracowników w bazie</p>
    @endif
</div>
    <!-- Modal -->
<div class="modal fade" id="pracownik" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Nowy pracownik</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'PracownicyController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                        {{Form::label('imie', 'Imię')}}
                        {{Form::text('imie', '', ['class' => 'form-control', 'placeholder' => 'Jan'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('nazwisko', 'Nazwisko')}}
                        {{Form::text('nazwisko', '', ['class' => 'form-control', 'placeholder' => 'Kowalski'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('tel', 'Telefon')}}
                        {{Form::text('tel', '', ['class' => 'form-control', 'placeholder' => '600 300 100'])}}
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
@endsection