<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReadNotificationController extends Controller
{
    public function index($id){
        try {
            $notification = Notification::find($id);

            if (!$notification) {
                return response()->json([
                    "message" => "Notification Data Doesn't Exist"
                ]);
            }

            if(!$notification->read_at){
                $notification->update([
                    'read_at' => Carbon::now()
                ]);
            }
            return response()->json([
                "message" => "Notification is seen Successfully",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }        


    }
}
