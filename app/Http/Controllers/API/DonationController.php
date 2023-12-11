<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BloodDonation;
use App\Models\Donor;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function index(Request $request){
        try{
            $data_validate = Validator::make($request->all(),
            [
                'donor_id'  => 'required|exists:donors,id',
                'bloodbankId'  => 'required|exists:blood_banks,id',
                'donnationDay'  => 'required',
                'donnationTime'  => 'required',
            ]);

            if ($data_validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $data_validate->errors()
                ], 401);
            }

            $data = [
                'donor_id' => $request->donor_id,
                'blood_bank_id' => $request->bloodbankId,
                'donation_date' => $request->donnationDay,
                'donation_time' => $request->donnationTime,
            ];

            $donation = BloodDonation::create($data);
            if($donation){
                $donor = Donor::find($request->donor_id);
                $donor->update([
                    'eligibility_status' => 'waiting',
                ]);

                return response()->json([
                    "message" => 'Creation is Successfully',
                    'requestStatus' => $donor->eligibility_status
                ]);
            }
            return response()->json([
                "message" => 'Creation is Faild',
            ]);

        }catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }        
    }
}
