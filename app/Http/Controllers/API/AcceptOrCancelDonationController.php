<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BloodDonation;
use App\Notifications\DonationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AcceptOrCancelDonationController extends Controller
{
    public function index(Request $request){
        try {
            $id = $request->input('donation_id');
            $status = $request->input('status');
            $reason = $request->input('cancel_reason');

            $rules = [
                'donation_id' => 'required|exists:blood_donations,id',
                'status' => 'required|in:accept,cancel', 
                'cancel_reason' => 'required_if:status,cancel|string|max:255',
            ];
            
            $validator = Validator::make($request->all(), $rules);
            
            // Check for validation errors
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ], 400);
            }

            $donation = BloodDonation::find($id);
            if (!$donation) {
                return response()->json([
                    "message" => "BloodDonation Data Doesn't Exist"
                ]);
            }

            $donation->update([
                'status' => $status,
                'cancel_reason' => $reason??$donation->cancel_reason
            ]);

            
            $message = $donation->BloodBank->location ."فى". $donation->BloodBank->name."تم قبول عينة دمك فى";
            if($status === 'cancel'){
                $message = $donation->BloodBank->location ."فى". $donation->BloodBank->name."تم رفض عينة دمك فى";
            }

            $don = $donation->Donor;
            Notification::send($don, new DonationNotification($message));

            return response()->json([
                "message" => "Data $status Successfully",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }        
    }
}
