<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;

class Zamowienie extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['author_id', 'client_id', 'vat', 'labor'];

    protected $table = 'zamowienia';

    protected $appends = ['created_ago', 'updated_ago', 'suma_wartosc_zakupu', 'suma_wartosc_sprzedazy', 'suma_wartosc_sprzedazy_brutto'];
    
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Klient');
    }

    public function getUpdatedAgoAttribute()
    {
        Date::setLocale('pl');
        $date = new Date($this->updated_at);
        return $date->ago();
    }

    public function getCreatedAgoAttribute()
    {
        Date::setLocale('pl');
        $date = new Date($this->created_at);
        return $date->ago();
    }

    public function getSumaWartoscZakupuAttribute()
    {
        $suma = 0;
        foreach($this->products as $product) {
            $suma += floor($product->cena_zakupu_netto * $product->pivot->ilosc * 100)/100;
        }
        return $suma;
    }

    public function getSumaWartoscSprzedazyAttribute()
    {
        $suma = 0;
        foreach($this->products as $product) {
            $suma += floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * 100)/100;
        }
        return $suma;
    }

    public function getSumaWartoscSprzedazyBruttoAttribute()
    {
        $suma = 0;
        foreach($this->products as $product){
            $suma += floor($product->cena_zakupu_netto * (1 + $product->pivot->marza / 100) * $product->pivot->ilosc * 100)/100;
        }
        return $suma;
    }

    public function products()
    {
        return $this->belongsToMany('App\Produkt', 'products_orders', 'order_id', 'product_id')->withPivot('ilosc', 'marza');
    }
}
