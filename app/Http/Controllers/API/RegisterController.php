<?php

namespace App\Http\Controllers\API;

use App\Enums\UserTypes;
use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Donor;
use App\Models\Hospital;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public static  $model;

    public function __construct(Request $request){
        self::$model = $request->userType;
    }
    public function index(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'phone' => 'required|unique:donors,contact_details|unique:hospitals,contact_details|unique:blood_banks,contact_details|unique:recipients,contact_details',                    'bloodType' => 'required_if:userType,donner,recipient',
                    'bloodTypes.*' => 'required_if:userType,Hospital,BloodBank',
                    'medicalHistory' => 'required_if:userType,recipient',
                    'location' => 'required_if:userType,Hospital,BloodBank',
                    'about' => 'required_if:userType,Hospital,BloodBank',
                    'image' => 'required_if:userType,Hospital,BloodBank',
                    'userType' => 'required',
                    'type' => 'required_if:userType,Recipient,Donor',
                    'bloodType' => 'required_if:userType,Donor,Recipient',
                    'birthDate' => 'required_if:userType,Donor,Recipient',
                ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }


            $data = [
                'about' => $request->about,
                'gender'  => $request->type,
                'birthDate' => $request->birthDate,
                'name' => $request->name,
                'contact_details' => $request->phone,
                'blood_type' => $request->bloodType,
                'blood_types' => $request->bloodTypes,
                'medical_history' =>  $request->medicalHistory,
                'location' => $request->location,
                'otp' => rand(1111, 9999),
                'image' => $request->image,
            ];

            $otp = $data['otp'];
            $modelName = self::$model;

            switch ($modelName){
                case "Donor":
                    $user = new Donor($data);
                    break;
                case "Hospital":
                    $user = new Hospital($data);
                    break;
                case "BloodBank":
                    $user = new BloodBank($data);
                    break;
                default:
                    $user = new Recipient($data);
                    break;
            }

            $user->save();


            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                "data" => $user,
                "userType" => $request->userType,
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
