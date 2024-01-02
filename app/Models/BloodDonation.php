<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodDonation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Donor(){
        return $this->belongsTo(Donor::class, 'donor_id');
    }
    public function BloodBank(){
        return $this->belongsTo(BloodBank::class, 'blood_bank_id');
    }
}
