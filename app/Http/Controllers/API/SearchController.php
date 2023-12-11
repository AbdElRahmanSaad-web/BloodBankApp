<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Hospital;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = [];
            if ($request->segment('2') == 'searchHospitals') {
                $data = Hospital::where('location', 'like', "%$request->location%")->orWhere('name', 'like', "%$request->name%")->get();
            } else {
                $data = BloodBank::where('location', 'like', "%$request->location%")->orWhere('name', 'like', "%$request->name%")->get();
            }
        
            if (count($data) == 0) {
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
