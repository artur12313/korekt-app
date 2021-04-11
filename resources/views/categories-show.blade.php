@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
            <h1>Kategoria <b>{{$category->name}}</b></h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#klient">Nowy produkt</button>
        </div>
            @if(count($category->products))
            <table class="table table-striped" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Jednostka</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Dostawca</th>
                        <th scope="col" class="text-center">Narzędzia</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($category->products as $product)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$product->nazwa}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->jednostka}}</td>
                    <td>{{$product->comma_price}}</td>
                    <td>{{$product->dostawca}}</td>
                    <td class="d-flex justify-content-center">
                    <a href="{{url("/products/$product->id/edit")}}" class="btn btn-primary btn-sm ml-2">Edytuj</a>
                    {!! Form::open(['action' => ['ProduktController@destroy', $product->id,], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                    {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                    {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>  
            @else
            <div>Brak produktów w tej kategorii</div>
            @endif
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="klient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Nowy produkt</h5>
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
         {!! Form::open(['action' => 'ProduktController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('nazwa', 'Nazwa produktu')}}
                {{Form::text('nazwa', '', ['class' => 'form-control', 'placeholder' => 'Nazwa...'])}}
            </div>
            <div class="form-group">
                {{Form::label('category_id', 'Kategoria')}}
                <select name="category_id" class="form-control">
                            <option value={{$category->id}} selected>{{$category->name}}</option>
                </select>
            </div>
            <div class="form-group">
                {{Form::label('jednostka', 'Jednostka')}}
                <select name="jednostka" class="form-control">
                    <option value="szt.">szt.</option>
                    <option value="m.b.">mb.</option>
                    <option value="kpl.">kpl.</option>
                    <option value="Kg.">Kg.</option>
                    <option value="opak.">opak.</option>
            </select>
            </div>
            <div class="form-group">
                {{Form::label('cena_zakupu_netto', 'Cena')}}
                {{Form::text('cena_zakupu_netto', '', ['class' => 'form-control', 'placeholder' => 'Cena'])}}
            </div>
            <div class="form-group">
                {{Form::label('dostawca', 'Dostawca')}}
                {{Form::text('dostawca', '', ['class' => 'form-control', 'placeholder' => 'Dostawca'])}}
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                {{Form::submit('Wyślij', ['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
        </div>
      </div>
    </div>
  </div>

@endsection