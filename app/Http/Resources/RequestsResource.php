<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'id'=> $this->id,
            'patientName' => $this->recipient->name??null,
            'bloodType' => $this->requested_blood_type,
            'quantity' => $this->quantity,
            'bloodBankId' => $this->blood_bank_id,
            'bloodBankLocation'=>  $this->blood_bank->location??null,
            'time' => $this->donation_time,
            'date' => $this->donation_date,
            'HospitalId' => $this->hospital_id,
            'HospitalLocation' =>  $this->hospital->location??'null',
        ];
    }
}
