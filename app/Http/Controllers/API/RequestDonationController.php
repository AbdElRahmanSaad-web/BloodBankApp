<?php

namespace App\Http\Controllers\API;

use App\Models\Requests;
use App\Models\Recipient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RequestDonationController extends Controller
{
    public function index(Request $request){
        try{
            $data_validate = Validator::make($request->all(),
            [
                'recipient_id'  => 'nullable|exists:recipients,id',
                'hospital_id'  => 'required|exists:hospitals,id',
                'blood_bank_id' => 'required_if:hospital_id,|required_without_all:recipient_id|exists:blood_banks,id',
                'quantity'  => 'required',
                'requested_blood_type'  => 'required',
                'donation_date'  => 'required',
                'donation_time'  => 'required',
            ]);

            if ($data_validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $data_validate->errors()
                ], 401);
            }

            $donation = Requests::create($request->all() + ['status' => 'waiting']);
            if($donation){
                return response()->json([
                    "message" => 'Creation is Successfully',
                    'requestStatus' => $donation->status
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
