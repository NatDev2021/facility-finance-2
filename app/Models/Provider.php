<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    public $table = 'provider';

    protected $fillable = [
        'person_id',
        'id_user_ins',
        'credit_account_id',
        'debit_account_id'
    ];

    public function personAddress()
    {

        return  $this->hasOneThrough(PersonAddress::class, Person::class, 'id', 'person_id', 'person_id');
    }
    public function personPhone()
    {

        return  $this->hasOneThrough(PersonPhone::class, Person::class, 'id', 'person_id', 'person_id');
    }

    public function person()
    {
        return $this->hasOne(Person::class, 'id', 'person_id');
    }
}
