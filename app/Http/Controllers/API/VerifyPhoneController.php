<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Donor;
use App\Models\Hospital;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VerifyPhoneController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'phone' => 'required',
                ]);


            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }




            $user = Donor::where('contact_details', $request->phone)->first()??
                    Hospital::where('contact_details', $request->phone)->first()??
                    BloodBank::where('contact_details', $request->phone)->first()??
                    Recipient::where('contact_details', $request->phone)->first();

            if($request->phone == $user->contact_details){
                $class = get_class($user);
                $arr = explode('\\', $class);                
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                    'userType' => $arr[2],
                    'name' => $user->name,
                    'otp'=> $user->otp,
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data is wrong',
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
