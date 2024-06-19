<?php

namespace App\Services;

use App\Models\BanksAccountsStatement;
use App\Models\CompanyBanksAccounts;
use Illuminate\Database\Eloquent\Model;

class BanksAccountsStatementService
{
    protected Model $banksAccountModel;
    protected Model $banksAccountStatementModel;

    public function __construct()
    {
        $this->banksAccountModel = new CompanyBanksAccounts();
        $this->banksAccountStatementModel = new BanksAccountsStatement();
    }


    public function insertStatement($idAccount, $description, $amount, $registerDate, $type, $idUserInsert, $transactionID = null)
    {
        $this->banksAccountStatementModel::create([
            'description' => $description,
            'register_date' => $registerDate,
            'banks_account_id' => $idAccount,
            'type' => $type,
            'amount' =>  $amount,
            'id_user_ins' => $idUserInsert,
            'transaction_id' => $transactionID
        ]);


        $account = $this->banksAccountModel::find($idAccount);
        $account->update([
            'account_balance' =>  $amount +  $account['account_balance'],
        ]);
        return $this;
    }
}
