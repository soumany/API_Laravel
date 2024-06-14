<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;


class OTPController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
        ]);

        $phone = $request->input('phone');
        $otp = rand(100000, 999999); // Generate a 6-digit OTP

        // Save the OTP and phone number in session or database for verification
        session(['otp' => $otp, 'phone' => $phone]);

        // Send OTP via Twilio
        $this->twilio->messages->create(
            $phone,
            [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => "Your OTP code is $otp"
            ]
        );

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
            'otp' => 'required|digits:6',
        ]);

        $phone = $request->input('phone');
        $otp = $request->input('otp');

        // Retrieve the OTP and phone number from session or database
        $sessionOtp = session('otp');
        $sessionPhone = session('phone');

        if ($phone == $sessionPhone && $otp == $sessionOtp) {
            // OTP is correct
            return response()->json(['message' => 'OTP verified successfully']);
        } else {
            // OTP is incorrect
            return response()->json(['message' => 'Invalid OTP'], 400);
        }
    }
}
