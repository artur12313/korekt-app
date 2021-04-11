<html style="font-family: DejaVu Sans; font-size: 10px;">
    <head>
        <meta charset="UTF-8"/>
            <meta http-equiv="Content-Type" content="text/html;"/>
    </head>
    <body>

        <img src="{{ base_path() }}/public/images/logo/baner.jpg" style=" width:100%;"/><br><br>

        <table style="font-size: 12px;">
            <tr>
            <td>KONTAKT:</td><td><p style="font-weight: bold;">Jan Kowalski 555 666 777<br>
                Jan Kowalski 555 666 777 </p></td>
            </tr>
            <tr style="color: red;">
                <td>E-mail:</td><td>example@example.com</td>
            </tr>
            <tr style="color: red;">
                <td>WWW</td><td>www.example.com</td>
            </tr>
        </table>
        <img src="{{ base_path() }}/public/images/qr/qr.jpg" style="position:absolute; top:100; right:225px;"/>             
        <hr style="color: red;">
        <h1 style="color: red; text-align: center;">ROZLICZENIE</h1>
            <span style="font-size:13px;">
            <p style="color: red;">Wykonano dla:</p>{{$klient->nazwa}}<br>
            <p style="color: red;">Dotyczy:</P>{{$klient->dotyczy}}<br>
            <p style="color: red;">Lokalizacja:</p>{{$klient->miejscowosc}} {{$klient->adres}}<br>
            <P style="color: red;">Zakres:</p>{{$klient->zakres}}<br>
            <br>
            <table border=1 style="border-collapse:collapse; width:80%; padding-left: 24%;">
                <tr>
                    <td><p style="color: red; padding-left:5px;">Wartość:</p></td>
                    <td><p style="color: red; padding-left:5px;">Netto</p></td>
                    <td><p style="color: red; padding-left:5px;">Vat</p></td>
                    <td><p style="color: red; padding-left:5px;">Brutto</p></td>
                </tr>
                <tr>
                    <td><p style="padding-left:5px;">Materiały:</p></td>
                    <td>
                        <p style="padding-left:5px;">{{number_format($suma_netto, 2, ',','')}} zł</p>
                    </td>
                    <td><p style="padding-left:5px;">{{$vat}}%</p></td>
                    <td>
                        <p style="padding-left:5px;">{{number_format($razem_produkty_brutto, 2, ',','')}} zł</p>
                    </td>
                </tr>
                <tr>
                    <td><p style="padding-left:5px;">Robocizna:</p></td>
                    <td>
                        <p style="padding-left:5px;">{{number_format($labor, 2, ',', '')}} zł</p>
                    </td>
                    <td><p style="padding-left:5px;">{{$vat}}%</p></td>
                    <td>                        
                        <p style="padding-left:5px;">{{number_format($labor_brutto, 2, ',', '')}} zł</p>
                    </td>
                </tr>
                <tr>
                <td><p style="padding-left:5px; font-weight:bold;">RAZEM: </p></td>
                <td><p style="padding-left:5px; font-weight:bold;">{{number_format($suma_netto, 2, ',', '')}} zł</p></td>
                <td><p style="padding-left:5px; font-weight:bold;">{{$vat}}%</p></td>
                <td><p style="padding-left:5px; font-weight:bold;">{{number_format($suma, 2, ',', '')}} zł</p></td>
                </tr>
            </table>
             <br><br>
            </p></span>
             
            <span style="position:absolute; bottom:2px; font-size: 12px;">
                <br><br>
                <span style="text-align: right;"><p>Sporządził {{$klient->author->name}} Tel.: {{$klient->author->tel}}
                       Bielsko–Biała dn. {{date('d-m-Y')}}</p></span>
                <hr style="color: brown;">
                 Jan Kowalski, Jan Kowalski S.C. nadgórze 44242 43-300 Bielsko-Biała
                <b>NIP</b> 44444444444 <b>REGON</b> 444444444 <b>EWIDENCJA DZIAŁALNOŚCI GOSPODARCZEJ</b> 22222 , 22222
                <b>BANK</b> BRE BANK SA mBank 77 8888 2222 0000 1111 5555 4444
            </span>
    </body>
    <body>
            @if(count($zamowienia) > 0)
            
        <h4 style="weight: bold; color: red; font-size: 15;">Zestawienie Materiałów</h4>
        <br>
        <table cellpadding="5" border="1" style="border-collapse:collapse; font-size: 12px; align: center;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nazwa</th>
                    <th>Ilość</th>
                    <th>cena netto</th>
                    <th>wartość netto</th>
                    <th>Vat</th>
                    <th>Cena brutto</th>
                    <th>Wartość brutto</th>
                </tr>
            </thead>
            {{$i=1}}
            @foreach($zamowienia as $zamowienie)
            <tbody>
            @foreach($zamowienie->products as $product)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$product->nazwa}}</td>
                    <td>{{$product->pivot->ilosc}} {{$product->jednostka}}</td>
                    <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * 100) / 100, 2, ',','') }} zł</td>
                    <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * 100) / 100, 2, ',','') }} zł</td>
                    <td>{{$zamowienie->vat}}%</td>
                    <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * (1 + $zamowienie->vat / 100) * 100) / 100, 2, ',','') }} zł</td>
                    <td>{{number_format(floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * (1 + $zamowienie->vat / 100) * 100) / 100, 2, ',','') }} zł</td>
                </tr>
            @endforeach
            </tbody>
            @endforeach
            <tfoot>
                <tr class="bg-info text-light font-weight-bold">
                    <td colspan="4" class="text-right">Razem:</td>
                    <td>{{number_format($razem_produkty, 2, ',', '')}} zł</td>
                    <td colspan="2" class="text-right">Razem:</td>
                    <td>{{number_format($razem_produkty_brutto, 2, ',','')}} zł</td>
                </tr>
            </tfoot>         
        </table>
         @else
                <p style="text-align:center; font-weight:bold ">Brak danych do wyświetlenia</p>
                @endif
    </body>
    <body>
        <span style="font-size:12px; color: red; font-weight:bold;">
        Oferta ważna - Oferta jest ważna 90 dni, z wyłączeniem cen kabli i przewodów elektrycznych,<br>
        które kalkulowane są na podstawie bieżących cen metali i podlegają co tygodniowej aktualizacji.<br>
        <br>
        OFERTA JEST WAŻNA JAKO CAŁOŚĆ, WYBIERANIE Z OFERTY POSZCZEGÓLNYCH SKŁADNIKÓW WYMAGA ODDZIELNYCH USTALEŃ.<br>
        <br>
        Gwarancje:<br>
        <br>
        Warunki gwarancji określa karta gwarancyjna producenta poszczególnego wyrobu z powyższej oferty.<br>
        <br>
        - Okres gwarancji liczony jest od daty sprzedaży zgodnej z paragonem fiskalnym lub fakturą VAT<br>
        <br> 
        - Na wykonane okablowanie i montaż osprzętu firma KOREKT S.C. udziela 36 miesięcznej gwarancji.<br>
        </span>
         <span style="position:absolute; bottom:2px; font-size: 12px;">
            <br><br>
         <hr style="color: brown;">
                    Jan Kowalski, Jan Kowalski S.C. nadgórze 44242 43-300 Bielsko-Biała
                <b>NIP</b> 44444444444 <b>REGON</b> 444444444 <b>EWIDENCJA DZIAŁALNOŚCI GOSPODARCZEJ</b> 22222 , 22222
                <b>BANK</b> BRE BANK SA mBank 77 8888 2222 0000 1111 5555 4444
        </span>
    </body>
</html>