<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "donation_date"=> $this->donation_date,
            "donation_time"=> $this->donation_time,
            "additional_info"=> $this->additional_info,

            'donor' => $this->Donor,

            'blood_bank' => $this->BloodBank

        ];
    }
}
