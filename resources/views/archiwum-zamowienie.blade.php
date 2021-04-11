@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Zamówienie {{$zamowienie->nazwa}}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dane zamówienia</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                Autor zamówienia: {{$zamowienie->author->name}} | 
                Klient: {{$zamowienie->client->nazwa}} |
                Stawka VAT: {{$zamowienie->vat}}%
            </h6>
        </div>
    </div>
    @if(isset($success))
        <div class="alert alert-success mt-3">
            {{$success}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>
        <div class="table-responsive">
    <table class="table table-striped table-sm" id="table">
        <thead class="thead-dark" style="font-size: 13px;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Cena zakupu netto</th>
                <th scope="col">Ilość</th>
                <th scope="col">Wartość zakupu netto</th>
                <th scope="col">Marża</th>
                <th scope="col">Cena sprzedaży netto</th>
                <th scope="col">Wartość sprzedaży netto</th>
                <th scope="col">Cena sprzedaży brutto</th>
                <th scope="col">Wartość sprzedaży brutto</th>
            </tr>
        </thead>
        <tbody style="font-size: 13px;">
            @foreach($zamowienie->products as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->nazwa}}</td>
                <td>
                    <a href={{url("/kategorie/" . $product->category->id)}}>
                        {{$product->category->name}}
                    <a>
                </td>
                <td>{{$product->comma_price}} zł</td>
                <td>{{$product->jednostka}}</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * $product->pivot->ilosc * 100)/100, 2, ',','') }} zł</td>
                <td>{{$product->pivot->marza}}%</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * 100) / 100, 2, ',','') }} zł</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * 100) / 100, 2, ',','') }} zł</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * (1 + $zamowienie->vat / 100) * 100) / 100, 2, ',','') }} zł</td>
                <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * (1 + $zamowienie->vat / 100) * 100) / 100, 2, ',','') }} zł</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-info text-light font-weight-bold">
                <td colspan="5" class="text-right">Razem:</td>
                <td>{{number_format($zamowienie->suma_wartosc_zakupu, 2, ',','')}} zł</td>
                <td colspan="2" class="text-right">Razem:</td>
                <td>{{number_format($zamowienie->suma_wartosc_sprzedazy, 2, ',','')}} zł</td>
                <td colspan="1" class="text-right">Razem:</td>
                <td>{{number_format(floor($zamowienie->suma_wartosc_sprzedazy_brutto * (1 + $zamowienie->vat / 100)*100)/100, 2, ',','') }} zł</td>
            </tr>
        </tfoot>
    </table>
        </div>
    {!! Form::close() !!}
</div>
@endsection