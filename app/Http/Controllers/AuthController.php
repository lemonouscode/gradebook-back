<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api',[
            'except' => [
                'login',
                'register'
            ]
            ]);
    }


    public function register(Request $request)
    {


        // First name: required,max:255
        // Last name: required, max:255
        // Email: required, email, max:255
        // Password: confirmed, at least 8 chars, at least 1 digit
        // Image url: required
        // Accepted terms and conditions


        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'image_url' => 'required',
            'tos' => 'required|boolean|accepted',
            'password' => ['required', 'min:8', 'regex:/\d/'],
            'password_confirmation' => 'required|same:password',
            // 'password' => 'required|min:8|numeric|min:1'
        ]);

        
        $request['password'] = Hash::make($request->password);

        $user = User::create($request->all());

        $token = Auth::login($user);

        $userId = Auth::id();

        return response()->json([
            'status' => 'success',
            'message' => 'User registered succefully',
            'user' => $user,
            'token' => $token,
            'userId' => $userId
        ]);

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        $token = Auth::attempt($credentials);

        $userId = Auth::id();

        if(!$token)
        {
            return response()->json([
                'status'=> 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        return response()->json([
            'status'=> 'success',
            'message' => 'loged in succefully',
            'token' => $token,
            'userId' => $userId
        ]);

    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

}
