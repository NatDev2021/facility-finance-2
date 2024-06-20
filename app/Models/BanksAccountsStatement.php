<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanksAccountsStatement extends Model
{
    use HasFactory;

    public $table = 'banks_accounts_statement';

    protected $fillable = [
        'description',
        'register_date',
        'banks_account_id',
        'type',
        'amount',
        'id_user_ins',
        'transaction_id',
        'origin'
    ];


    public function transactionFiles()
    {
        return $this->hasMany(FinancialTransactionsFiles::class, 'transaction_id');

    }
}
