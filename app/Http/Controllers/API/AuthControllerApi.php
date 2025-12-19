<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthControllerApi extends Controller
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

        // Necessari perque sino IntelliSense no reconeixeria la variable $user
        /** @var \App\Models\User $user */

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        $minutes = 60 * 24 * 7; 
        $response = response()->json(['token' => $token], 200);

        // Si no espera JSON, afegim el token a cookies i redirigim
        if (! $request->expectsJson()) {
            $secure = config('app.env') === 'production';
            return redirect()->route('students.index')
                ->cookie('api_token', $token, $minutes, '/', null, $secure, true, false, 'Lax');
        }

        return $response;
    }
}