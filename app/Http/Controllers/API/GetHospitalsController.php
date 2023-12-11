<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class GetHospitalsController extends Controller
{
    public function index(){
        $hospitals = Hospital::get();

        if(count($hospitals) == 0){
            return response()->json([
                'message' => 'Not Have Hospitals Data',
            ]);    
        }
        return response()->json([
            'message' => 'Hospitals Retrieved Successfully',
            'data' => $hospitals,
        ]);
    }
}
