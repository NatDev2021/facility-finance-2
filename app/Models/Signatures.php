<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatures extends Model
{
    use HasFactory;


    protected $fillable = [
        'external_id',
        'token',
        'name',
        'folder_path',
        'status',
        'file_name',
        'path',
        'created_by'
    ];
}
