<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'icon',
        'actived',
        'initial_status_id',
        'final_status_id' ,
        'id_user_ins'
        
    ];

    public function initialStatus()
    {
        return $this->hasOne(Status::class, 'id', 'initial_status_id');
    }

    public function finalStatus()
    {
        return $this->hasOne(Status::class, 'id', 'final_status_id');
    }

    public function documents()
    {
        return $this->hasMany(ProductsDocuments::class, 'product_id');
    }

    public function parametrizations()
    {
        return $this->hasMany(ProductsParametrization::class, 'product_id');
    }


}
