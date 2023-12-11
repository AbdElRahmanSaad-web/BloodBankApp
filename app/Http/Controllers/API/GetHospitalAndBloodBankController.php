<?php

namespace App\Http\Controllers\API;

use App\Models\Hospital;
use App\Models\BloodBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetHospitalAndBloodBankController extends Controller
{
    public function index(Request $request, $id){
        try {
            $data = [];
            if ($request->segment('2') == 'getHospital') {
                $data = Hospital::find($id);
            } else {
                $data = BloodBank::find($id);
            }
           
            if (!$data) {
                return response()->json([
                    "message" => "No Data Founded"
                ]);
            }

            return response()->json([
                "message" => "Data Retrieved Successfully",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }        
    }
}
