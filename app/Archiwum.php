<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archiwum extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'nazwa', 'adres', 'miejscowosc', 'tel', 'author_id',
    ];
    
    protected $appends = ['razem_wartosc_sprzedazy', 'razem_wartosc_zakupu'];

    protected $table = 'klienci';

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function zamowienia()
    {
        return $this->hasMany('App\Zamowienie', 'client_id')->onlyTrashed();
    }

    public function getRazemWartoscSprzedazyAttribute()
    {
        $razemWartoscSprzedazy = 0;
        foreach($this->zamowienia as $zamowienie) {
            $razemWartoscSprzedazy += $zamowienie->suma_wartosc_sprzedazy;
        }
        return $razemWartoscSprzedazy;
    }

    public function getRazemWartoscZakupuAttribute()
    {
        $razemWartoscZakupu = 0;
        foreach($this->zamowienia as $zamowienie) {
            $razemWartoscZakupu += $zamowienie->suma_wartosc_zakupu;
        }
        return $razemWartoscZakupu;
    }

    public function getRazemWartoscSprzedazyBruttoAttribute()
    {
        $razemWartoscSprzedazyBrutto = 0;
        foreach($this->zamowienia as $zamowienie) {
            $razemWartoscSprzedazyBrutto += $zamowienie->suma_wartosc_sprzedazy_brutto;
        }
        return $razemWartoscSprzedazyBrutto;
    }
}
