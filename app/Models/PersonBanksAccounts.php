<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonBanksAccounts extends Model
{
    use HasFactory;

    public $table = 'person_banks_accounts';

    protected $fillable = [
        'person_id',
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


}
