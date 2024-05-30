<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialMovement extends Model
{
    use HasFactory;

    public $table = 'financial_movement';

    protected $fillable = [
        'description',
        'date',
        'value_amount',
        'note',
        'type',
        'id_user_ins',
    ];
}
