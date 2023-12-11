<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class BloodBank extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $casts = [
        'bloodTypes' => 'array',
    ];

    protected $fillable=[
        'name',
        'contact_details',
        'blood_types',
        'otp',
        'location',
        'about',
        'image',
    ];

}
