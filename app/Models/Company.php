<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $table = 'company';

    protected $fillable = [
        'document',
        'company_name',
        'business_name',
        'zip_code',
        'country',
        'state',
        'city',
        'street_address',
        'address_number',
        'complement',
        'neighborhood',
    ];

}
