<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Donor extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $fillable=[
        'name',
        'contact_details',
        'blood_type',
        'otp',
        'gender',
        'birthDate',
        'eligibility_status'
    ];

    public function BloodDonation(){
        return $this->hasMany(BloodDonation::class, 'donor_id');
    }
}
