<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoansFiles extends Model
{
    use HasFactory;

    public $table = 'loans_files';

    protected $fillable = [
        'loan_id',
        'file_name',
        'file_size',
        'mime_type',
        'path',
        'id_user_ins',
    ];
}
