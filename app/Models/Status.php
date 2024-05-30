<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $table = 'status';

    protected $fillable = [
        'description',
        'color',
        'actived'
    ];

    public function initialStatus()
    {
        return $this->hasMany(Products::class, 'initial_status_id');
    }

    public function finalStatus()
    {
        return $this->hasMany(Products::class, 'final_status_id');
    }

    public function loans()
    {
        return $this->hasMany(Loans::class, 'status_id');

    }
}
