<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingFinancial extends Model
{
    use HasFactory;

    public $table = 'accounting_financial';

    protected $fillable = [
        'description',
        'name',
        'account',
        'start_duration_date',
        'end_duration_date',
        'id_user_ins'
    ];


}
