<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public $table = 'person';

    protected $fillable = [
        'document',
        'name',
        'date_birthday',
        'email',
        'representative',
        'id_user_ins'
    ];


    public function address()
    {
        return $this->hasMany(PersonAddress::class, 'person_id');
    }

    public function phone()
    {
        return $this->hasMany(PersonPhone::class, 'person_id');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'person_id');
    }


}
