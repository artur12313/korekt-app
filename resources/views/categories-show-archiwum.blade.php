@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
            <h1>Kategoria <b>{{$category->name}}</b></h1>
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
                    {{Form::hidden()}}
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
@endsection