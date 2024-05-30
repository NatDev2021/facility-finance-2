<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{
    use HasFactory;
    public $table = 'person_address';

    protected $fillable = [
        'person_id',
        'zip_code',
        'country',
        'state',
        'city',
        'street_address',
        'address_number',
        'complement',
        'neighborhood',
        'primary',
        'id_user_ins'
    ];

}
