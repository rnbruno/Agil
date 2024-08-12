<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Type_user;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        // dd($request->password, $user->password);
        $token = strcasecmp($request->password, $user->password);
        // $token = auth()->attempt($credentials);
        if ($request->password !== $user->password) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        
        Auth::login($user);

        if (isset($user['id_int'])) {
            $user->verificar = $user['id_int'];
            $typ_e = Type_user::find($user['type_user']);
        } else {
            $user->verificar = '0';
            $typ_e = 0;
        }


        $user->nameType = $typ_e ?  $typ_e["name"] : 'Tipo desconhecido';
        return response()->json([
            'status' => 'success',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function register(Request $request){
 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $hashedPassword = password_hash($request->password, PASSWORD_BCRYPT);
        $id = Str::uuid()->toString();
        $user = User::create([
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $request->password,
        ]);
        // dd($user['password']);

        $token = auth()->login($user);

        Mail::to($user->email)->send(new WelcomeMail($user));


        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => auth()->user(),
            'authorization' => [
                'token' => auth()->refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
