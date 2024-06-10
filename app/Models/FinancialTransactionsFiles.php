<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransactionsFiles extends Model
{
    use HasFactory;

    public $table = 'financial_transactions_files';

    protected $fillable = [
        'transaction_id',
        'file_name',
        'file_size',
        'mime_type',
        'path',
        'id_user_ins',
    ];
}
