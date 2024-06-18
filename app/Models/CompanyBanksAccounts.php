<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBanksAccounts extends Model
{
    use HasFactory;

    public $table = 'company_banks_accounts';

    protected $fillable = [
        'company_id',
        'bank_id',
        'description',
        'agency',
        'account',
        'account_dig',
        'account_balance',
        'pix_key',
        'id_user_ins',
    ];


    public function bank()
    {
        return $this->hasOne(Banks::class, 'id', 'bank_id');
    }

    public function financialTransaction()
    {
        return $this->hasOne(FinancialTransactions::class, 'disbursement_account_id');
    }
}
