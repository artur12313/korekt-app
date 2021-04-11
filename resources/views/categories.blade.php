@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista kategorii</h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nowa">Nowa kategoria</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <table class="table table-striped table-bordered" id="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nazwa</th>
            <th scope="col" class="text-center">Narzędzia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$cat->name}}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{url("/kategorie/$cat->id")}}" class="btn btn-secondary btn-sm">Pokaż</a>
                    <form>
                    <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#edit">Edytuj</button>
                    </form>
                    {!! Form::open(['action' => ['CategoryController@destroy', $cat->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                        {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal nowa kategoria -->
  <div class="modal fade" id="nowa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Nowa kategoria</h5>
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
            {!! Form::open(['action' => 'CategoryController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('name', 'Nazwa kategorii')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nazwa...'])}}
            </div>
            <hr>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          {{Form::submit('Zapisz zmiany', ['class'=>'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- End modal -->

     <!-- Modal edycja kategorii -->
     <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Edytuj kategorię</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action' => ['CategoryController@update', $cat->id], 'method' => 'PUT']) !!}
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
            @if($cat)
            <div class="form-group">
                 <label for="name">Nazwa kategorii</label>
            <input type="text" name="name" id="name" class="form-control"/>
            </div>
            <hr>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
              <div class="d-flex justify-content-end">
                {{Form::submit('Zapisz zmiany', ['class'=>'btn btn-primary'])}}
            </div>
            </div>
            {!! Form::close() !!}
            @endif
          </div>
        </div>
      </div>
</div>   
@endsection
