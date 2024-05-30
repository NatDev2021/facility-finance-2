<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsParametrization extends Model
{
    use HasFactory;

    public $table = 'products_parametrization';


    protected $fillable = [
        'description',
        'product_id',
        'interest_rate',
        'commission_rate',
        'installments',
        'id_user_ins',
        'actived'
    ];

    public function charges()
    {
        return $this->hasMany(ProductsParametrizationCharges::class, 'parametrization_id');
    }


    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
