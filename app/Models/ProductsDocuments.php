<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsDocuments extends Model
{
    use HasFactory;

    public $table = 'products_documents';

    protected $fillable = [
        'document_id',
        'product_id',
        'id_user_ins',
    ];
}
