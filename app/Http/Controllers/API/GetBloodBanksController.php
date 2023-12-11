<?php

namespace App\Http\Controllers\API;

use App\Models\BloodBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetBloodBanksController extends Controller
{
    public function index(){
        $BloodBanks = BloodBank::get();

        if(count($BloodBanks) == 0){
            return response()->json([
                'message' => 'Not Have BloodBanks Data',
            ]);    
        }
        return response()->json([
            'message' => 'BloodBanks Retrieved Successfully',
            'data' => $BloodBanks,
        ]);
    }
}
