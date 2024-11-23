<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors(),
                ],
                422,
            );
        }

        $credential = $request->only(['email', 'password']);
        if (Auth::attempt($credential)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('token')->plainTextToken;
            return response()->json(
                [
                    'message' => 'login berhasil',
                    'token' => $success['token'],
                ],
                200,
            );
        }
        return response()->json(
            [
                'message' => 'email or password invalid',
            ],
            401,
        );
    }
}
