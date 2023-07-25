<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Auth\EmailVerificationRequest;
use Otp;


class EmailVerificationController extends Controller
{

    private $otp;
    public function __construct() {
        $this->otp = new Otp;
    }

    public function email_verification(EmailVerificationRequest $request) {
        $otp1 = $this->otp->validate($request->email, $request->otp);
        
        if(!$otp1->status) {
            return response()->json(['error' => $otp1], 401);
        }
        $user = User::where('email', $request->email)->First();
        $user->update(['email_verified_at' => now()]);

        $success['success'] = true;
        
        return response()->json($success,200);

    }
}
