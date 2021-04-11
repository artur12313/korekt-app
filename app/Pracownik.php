<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pracownik extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'imie', 'nazwisko', 'nrkonta', 'tel'
    ];

    protected $table = 'pracownicy';

    public function rozliczenia()
    {
        return $this->hasMany('App\Rozliczenia', 'pracownik_id');
    }
}
