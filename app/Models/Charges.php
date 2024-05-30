<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'actived',
        'type',
        'id_user_ins'

    ];
}
