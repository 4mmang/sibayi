<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors()->get('name')[0] ?? ($validator->errors()->get('email')[0] ?? $validator->errors()->get('password')[0]),
                ],
                422,
            );
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('token')->plainTextToken;
                return response()->json(
                    [
                        'message' => 'Registrasi berhasil',
                        'token' => $success['token'],
                    ],
                    200,
                );
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                ],
                500,
            );
        }
    }
}
