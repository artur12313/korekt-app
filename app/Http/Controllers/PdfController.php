<?php

namespace App\Http\Controllers;
use Session;
use App\Http\Conreollers\Conreoller;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Zamowienie;
use App\Klient;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class PdfController extends Controller
{
    public function pdf(Request $request, $id)
    {
        $klient = Klient::find($id);
        
        $zamowienia = $klient->zamowienia->whereIn('id', $request->zamowienie);
        
        
        $labor = 0;
        $labor_brutto = 0;
        $razem_produkty = 0;
        $razem_produkty_netto = 0;
        $razem_produkty_brutto = 0;

        foreach($zamowienia as $zamowienie)
        {
            $labor = $klient->razem_robocizna;
            $labor_brutto = ($labor * (1 + $zamowienie->vat / 100)*100)/100;
            $razem_produkty += $zamowienie->suma_wartosc_sprzedazy;
            $razem_produkty_netto += $zamowienie->suma_wartosc_sprzedazy;
            $razem_produkty_brutto += ($zamowienie->suma_wartosc_sprzedazy_brutto * (1 + $zamowienie->vat / 100)*100)/100;

        }
        $suma = $labor + $razem_produkty_brutto;
        $suma_netto = $razem_produkty_netto;
        $vat = $zamowienie->vat;

        $pdf = PDF::loadView('PDF', ['zamowienia' => $zamowienia, 'klient' => $klient, 'razem_produkty' => $razem_produkty ,'razem_produkty_brutto' => $razem_produkty_brutto,
        'labor' => $labor, 'suma' => $suma, 'suma_netto' => $suma_netto, 'labor_brutto' => $labor_brutto, 'vat' => $vat]);
        $dompdf = new Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true);
        
           return $pdf->stream();
    }

    public function oferta(Request $request, $id)
    {
        $klient = Klient::find($id);
        
        $zamowienia = $klient->zamowienia->whereIn('id', $request->zamowienie);
        
        
        $labor = 0;
        $labor_brutto = 0;
        $razem_produkty = 0;
        $razem_produkty_netto = 0;
        $razem_produkty_brutto = 0;

        foreach($zamowienia as $zamowienie)
        {
            $labor = $klient->razem_robocizna;
            $labor_brutto = ($labor * (1 + $zamowienie->vat / 100)*100)/100;
            $razem_produkty += $zamowienie->suma_wartosc_sprzedazy;
            $razem_produkty_netto += $zamowienie->suma_wartosc_sprzedazy;
            $razem_produkty_brutto += ($zamowienie->suma_wartosc_sprzedazy_brutto * (1 + $zamowienie->vat / 100)*100)/100;
        }
        $suma = $labor + $razem_produkty_brutto;
        $suma_netto = $razem_produkty_netto;
        $vat = $zamowienie->vat;

        $pdf = PDF::loadView('PDF-oferta', ['zamowienia' => $zamowienia, 'klient' => $klient, 'razem_produkty' => $razem_produkty ,'razem_produkty_brutto' => $razem_produkty_brutto,
         'labor' => $labor, 'suma' => $suma, 'suma_netto' => $suma_netto, 'labor_brutto' => $labor_brutto, 'vat' => $vat]);
        $dompdf = new Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true);
        
           return $pdf->stream();
    }
}