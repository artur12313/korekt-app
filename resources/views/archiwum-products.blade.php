@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista Produktów(archiwum)</h1>
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
            <th scope="col">Nazwa</th>
            <th scope="col">Kategoria</th>
            <th scope="col">Jednostka</th>
            <th scope="col">Cena</th>
            <th scope="col">Dostawca</th>
            <th scope="col">Data aktualizacji</th>
            <th scope="col" class="text-center">Narzędzia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->nazwa}}</td>
                <td>
                    @if($product->category)
                    <a href={{url("/kategorie/" . $product->category->id)}}>
                        {{$product->category->name}}
                    </a>
                    @endif
                </td>
                <td>{{$product->jednostka}}</td>
                <td>{{$product->comma_price}}</td>
                <td>{{$product->dostawca}}</td>
                <td>{{date("d-m-Y", strtotime($product->updated_at))}}</td>       
                <td class="d-flex justify-content-center">
                    {!! Form::open(['action' => ['ProduktController@forceDelete', $product->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                        {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection