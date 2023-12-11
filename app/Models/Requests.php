<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;
    protected $table = 'requests', $guarded = [];

    public function recipient(){
        return $this->belongsTo(Recipient::class);
    }
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
    public function blood_bank(){
        return $this->belongsTo(BloodBank::class);
    }
}
