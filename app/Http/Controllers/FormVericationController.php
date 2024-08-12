<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FormVericationController extends Controller
{

    public static function getLogin(Request $request)
    {
        // dd($request->password);
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($request->password !== $user->password) {
            return response()->json([
                'status' => false,
            ]);
        }
        return response()->json([
            'status' => true,
        ]);
    }
}
