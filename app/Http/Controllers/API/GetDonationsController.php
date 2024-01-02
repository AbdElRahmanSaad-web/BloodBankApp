<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Models\Donor;
use Illuminate\Http\Request;

class GetDonationsController extends Controller
{
    public function index(Request $request){
        try {
            $id = $request->input('donation_id');

            $donor = Donor::find(auth()->user()->id);
            if (!$donor) {
                return response()->json([
                    "message" => "Donor Data Doesn't Exist"
                ]);
            }

            $donations = $donor->BloodDonation;
            if(isset($id)){
                $donations = $donations->where('id', $id);
            }

            return response()->json([
                "message" => "Data Retrieved Successfully",
                "data" => DonationResource::collection($donations) 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }        
    }
}
