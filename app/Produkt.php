<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produkt extends Model
{
    use SoftDeletes;

    protected $table = "produkty";

    protected $fillable = [
        'nazwa', 'jednostka', 'dostawca', 'cena_zakupu_netto', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Zamowienie', 'products_orders');
    }

    public function getCommaPriceAttribute()
    {
        echo (number_format($this->cena_zakupu_netto, 2, ',',''));
    }
} 
