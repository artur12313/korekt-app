<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zadania extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'author_id'
    ];

    protected $table = 'zadania';

    public function author()
    {
        return $this->belongsTo('App\User');
    }
    public function client()
    {
        return $this->belongsTo('App\Klient');
    }
    
    public function rozliczenia()
    {
        return $this->belongsToMany('App\Rozliczenia', 'pomocnicza_zadania', 'zadanie_id', 'rozliczenie_id');
    }
}
