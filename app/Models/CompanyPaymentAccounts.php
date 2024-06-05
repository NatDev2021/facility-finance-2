<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPaymentAccounts extends Model
{
    use HasFactory;

    public $table = 'company_payment_accounts';

    protected $fillable = [
        'company_id',
        'bank_id',
        'description',
        'agency',
        'account',
        'account_dig',
        'pix_key',
        'id_user_ins',
    ];

}
