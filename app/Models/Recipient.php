<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Recipient extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable=[
        'name',
        'contact_details',
        'otp',
        'blood_type',
        'medical_history',
        'gender',
        'birthDate',
        'eligibility_status'
    ];
}
