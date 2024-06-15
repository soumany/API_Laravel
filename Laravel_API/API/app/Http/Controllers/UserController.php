<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\rentroom;
//for otp
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Laravel\Socialite\Facades\Socialite;
use Nexmo\Laravel\Facade\Nexmo;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create a new user
        $user = new User;
        $user->name = $request->input('firstname');
        $user->name = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();
        // Send OTP email
        Notification::send($user, new rentroom($otp));
        return response()->json($user, 201);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return response()->json(['message' => 'OTP verified successfully'], 200);
    }

    public function show($id)
    {
        // Retrieve a single user
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Update a user
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        // Delete a user
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();

        return response()->json(null, 204);
    }

    //===========================OTP========================
    /**
     * Send OTP via SMS using Vonage (Nexmo).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function sendOtpViaSms(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'phone' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $user = User::where('phone', $request->input('phone'))->first();

    //     if (!$user) {
    //         return response()->json(['error' => 'User not found'], 404);
    //     }

    //     $otp = rand(100000, 999999);
    //     $user->otp = $otp;
    //     $user->save();

    //     // Send OTP via Vonage SMS
    //     try {
    //         Notification::message()->send([
    //             'to' => $request->input('phone'),
    //             'from' => env('VONAGE_BRAND_NAME'), // Assuming you've set this in your .env file
    //             'text' => "Your OTP code is: $otp"
    //         ]);

    //         return response()->json(['message' => 'OTP sent successfully']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to send OTP', 'details' => $e->getMessage()], 500);
    //     }
    // }

    // Other methods like verifyOtp, update, delete, etc. remain unchanged or as per your requirements.
}
