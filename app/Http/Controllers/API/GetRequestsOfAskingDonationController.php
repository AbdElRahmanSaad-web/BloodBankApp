<?php

namespace App\Http\Controllers\API;

use App\Models\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestsResource;

class GetRequestsOfAskingDonationController extends Controller
{
    public function index(Request $request){
        $requests = Requests::get();
        if($request->id){
            $requests = Requests::find($request->id);
            return response()->json([
                'message' => 'Donation Requests Retrieved Successfully',
                'data' => new RequestsResource($requests),
            ]);
        }
        if(count($requests) == 0){
            return response()->json([
                'message' => 'Not Have Requests of Donation Data',
            ]);    
        }
        return response()->json([
            'message' => 'Donation Requests Retrieved Successfully',
            'data' => RequestsResource::collection($requests),
        ]);
    }
}
