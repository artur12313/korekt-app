<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rozliczenia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'opis','pracownik_id'
    ];

    protected $table = 'rozliczenia';

    public function pracownik()
    {
        return $this->belongsTo('App\Pracownik');
    }

    public function zadania()
    {
        return $this->belongsToMany('App\Zadania', 'pomocnicza_zadania', 'rozliczenie_id', 'zadanie_id')->withPivot('czas', 'stawka');
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function getSumaGodzinPracyAttribute()
    {
        $suma_godzin_pracy = 0;
        foreach($this->zadania as $zadanie)
        {
            $suma_godzin_pracy += $zadanie->pivot->czas;
        }
        return $suma_godzin_pracy;
    }

    public function getWynagrodzenieAttribute()
    {
        $wynagrodzenie = 0;
        foreach($this->zadania as $zadanie)
        {
            $wynagrodzenie += $zadanie->pivot->czas * $zadanie->pivot->stawka;
        }
        return $wynagrodzenie;
    }
}
