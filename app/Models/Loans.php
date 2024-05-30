<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_amount',
        'installments',
        'installment_amount',
        'interest_rate',
        'interest_rate_month',
        'interest_amount',
        'commission_rate',
        'commission_amount',
        'financed_amount',
        'disbursement_date',
        'status_id',
        'customer_id',
        'parametrization_id',
        'note',
        'cardholder',
        'id_user_ins'
    ];

    public function signature(){
        return $this->hasMany(Signatures::class, 'external_id', 'id');
    }


    public function userInsert()
    {
        return $this->hasOne(User::class, 'id', 'id_user_ins');
    }

    public function holder()
    {
        return $this->hasOne(Person::class, 'id', 'cardholder');
    }

    public function holderAddress()
    {

        return  $this->hasOneThrough(PersonAddress::class, Person::class, 'id', 'person_id', 'cardholder');
    }

}
