<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
        Auth::user()->currentAccessToken()->update([
            "expires_at"=>now()
        ]);
        return response()->json([
            'status' => true,
            'message' => 'you logout successfully!',
        ], 200);
    }
}
