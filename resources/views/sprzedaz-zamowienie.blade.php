@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Zamówienie o id {{$zamowienie->id}}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dane zamówienia</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                Autor zamówienia: {{$zamowienie->author->name}} | 
                Klient: {{$zamowienie->client->nazwa}} |
                Stawka VAT: {{$zamowienie->vat}}%
            </h6>
        </div>       
    </div><br>
    <div class="d-flex justify-content-between align-items-center">
        <h1><b></b></h1>
        </div><br>
    <table class="table table-striped" id="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena netto</th>
                <th scope="col">Wartość netto</th>
                <th scope="col">Cena brutto</th>
                <th scope="col">Wartość brutto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zamowienie->products as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->nazwa}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->pivot->ilosc}} {{$product->jednostka}}</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * 100) / 100, 2, ',',' - ') }} zł</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * 100) / 100, 2, ',','') }} zł</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * (1 + $zamowienie->vat / 100) * 100) / 100, 2, ',','') }} zł</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * (1 + $zamowienie->vat / 100) * 100) / 100, 2, ',','') }} zł</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-info text-light font-weight-bold">
                <td colspan="5" class="text-right">Razem:</td>
                <td>{{number_format($zamowienie->suma_wartosc_sprzedazy, 2, ',','')}} zł</td>
                <td colspan="1" class="text-right">Razem:</td>
                <td>{{number_format(floor($zamowienie->suma_wartosc_sprzedazy_brutto * (1 + $zamowienie->vat / 100)*100)/100, 2, ',','') }} zł</td>
            </tr>
        </tfoot>
    </table>  
</div>
@endsection