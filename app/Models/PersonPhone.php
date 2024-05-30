<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonPhone extends Model
{
    use HasFactory;

    public $table = 'person_phone';

    protected $fillable = [
        'person_id',
        'phone',
        'primary',
        'id_user_ins'
    ];

}
