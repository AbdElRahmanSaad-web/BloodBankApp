<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        try {
            $notifications = Notification::get();

            if (!$notifications) {
                return response()->json([
                    "message" => "Notification Data Doesn't Exist"
                ]);
            }

            return response()->json([
                "message" => "Data Retrieved Successfully",
                "data" => NotificationResource::collection($notifications) 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }        

    }
}
