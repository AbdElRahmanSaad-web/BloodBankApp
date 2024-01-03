<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Donor;
use App\Models\Hospital;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyOtpController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'phone' => 'required',
                    'otp' => 'required',
                ]);


            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }




            $user = Donor::where('otp', $request->otp)->where('contact_details', $request->phone)->first()??
                Hospital::where('otp', $request->otp)->where('contact_details', $request->phone)->first()??
                BloodBank::where('otp', $request->otp)->where('contact_details', $request->phone)->first()??
                Recipient::where('otp', $request->otp)->where('contact_details', $request->phone)->first();

            if($request->otp == $user->otp){

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Otp is wrong',
                ], 401);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
