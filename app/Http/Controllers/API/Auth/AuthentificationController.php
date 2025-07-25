<?php

namespace App\Http\Controllers\API\Auth;

use App\Enums\GenderEnum;
use App\Enums\OccupationEnum;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Enum;

class AuthentificationController extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'password' => ['required', Rules\Password::defaults()],
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('token')->plainTextToken;
            Auth::login($user);
            return response()->json(['type' => 'success', 'message' => 'User created successfully', 'token' => $token, 'user_type' => 'user']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['type' => 'error', 'message' => 'Invalid email or password'], 401);
            }

            $token = $user->createToken('token')->plainTextToken;
            Auth::login($user);

            return response()->json([
                'type' => 'success',
                'message' => 'User logged in successfully',
                'user_type' => 'user',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    public function user(Request $request){
        return response()->json([
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'token' => $request->bearerToken(),
        ]);
    }

    public function registerProvider(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'birthdate' => 'required|date',
                'gender' => ['required', new Enum(GenderEnum::class)],
                'occupation' => ['required', new Enum(occupationEnum::class)],
                'email' => 'required|string|lowercase|email|max:255|unique:' . Provider::class,
                'phone' => 'required|string|max:255',
                'pay_per_hour' => 'required|numeric',
                'profile_image' => 'nullable|string|max:255',
                'id_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'verification_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'password' => ['required', Rules\Password::defaults()],
            ]);
            $provider = Provider::create([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'occupation' => $request->occupation,
                'email' => $request->email,
                'phone' => $request->phone,
                'pay_per_hour' => $request->pay_per_hour,
                'profile_image' => $request->profile_image,
                'email_verified_at' => $request->email_verified_at,
                'password' => Hash::make($request->password),
            ]);
            $token = $provider->createToken('token')->plainTextToken;
            Auth::login($provider);
            return response()->json(['type' => 'success', 'message' => 'Provider created successfully', 'token' => $token, 'user_type' => 'provider']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function loginProvider(Request $request)
    {
        try {
            $provider = Provider::where('email', $request->email)->first();

            if (!$provider || !Hash::check($request->password, $provider->password)) {
                return response()->json(['type' => 'error', 'message' => 'Invalid email or password'], 401);
            }

            $token = $provider->createToken('token')->plainTextToken;
            Auth::login($provider);

            return response()->json([
                'type' => 'success',
                'message' => 'User logged in successfully',
                'user_type' => 'provider',
                'token' => $token,
                'provider' => $provider,
            ]);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function provider(Request $request){
        return response()->json([
            'name' => $request->user()->name,
            'birthdate' => $request->user()->birthdate,
            'gender' => $request->user()->gender,
            'occupation' => $request->user()->occupation,
            'email' => $request->user()->email,
            'phone' => $request->user()->phone,
            'pay_per_hour' => $request->user()->pay_per_hour,
            'profile_image' => $request->user()->profile_image,
        ]);
    }



}
