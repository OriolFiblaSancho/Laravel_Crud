<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        // Sino poso esta linea, intelliPhense se queja
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        $minutes = 60 * 24 * 7; // 7 days

        return redirect()
            ->route('students.index')
            ->cookie('api_token', $token, $minutes, '/', null, false, false, false, 'Lax');
    }

    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
        }
        Auth::logout();

        return redirect()
            ->route('login')
            ->cookie(Cookie::forget('api_token'));
    }
}
