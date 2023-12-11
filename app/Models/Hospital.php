<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Hospital extends Authenticatable
{
    use HasFactory, HasApiTokens;

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
