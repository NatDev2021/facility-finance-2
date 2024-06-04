<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransactions extends Model
{
    use HasFactory;

    public $table = 'financial_transactions';

    protected $fillable = [
        'description',
        'date_due',
        'amount',
        'customer_provider_id',
        'credit_account_id',
        'debit_account_id',
        'type',
        'observation',
        'id_user_ins',
    ];
}
