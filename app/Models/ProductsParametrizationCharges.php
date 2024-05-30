<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsParametrizationCharges extends Model
{
    use HasFactory;

    public $table = 'products_parametrization_charges';

    protected $fillable = [
        'charge_id',
        'parametrization_id',
        'id_user_ins',
    ];
}
