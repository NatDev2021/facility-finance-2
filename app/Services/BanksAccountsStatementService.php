<?php

namespace App\Services;

use App\Models\CompanyBanksAccounts;
use Illuminate\Database\Eloquent\Model;

class BanksAccountsStatementService
{
    protected Model $banksAccountmodel;

    public function __construct(){
        $this->banksAccountmodel = new CompanyBanksAccounts();
    }


    public function insertStatement(){

    }
}
