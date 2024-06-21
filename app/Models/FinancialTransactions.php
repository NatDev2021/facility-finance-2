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
        'register_date',
        'due_date',
        'pay_date',
        'value',
        'addition',
        'discount',
        'amount',
        'customer_provider_id',
        'credit_account_id',
        'debit_account_id',
        'disbursement_account_id',
        'type',
        'observation',
        'id_user_ins',
        'payment_method_id',
        'document_number',
        'document_key',
        'reference_transaction_id'
    ];


    public function transactionFiles()
    {
        return $this->hasMany(FinancialTransactionsFiles::class, 'transaction_id');

    }
}
