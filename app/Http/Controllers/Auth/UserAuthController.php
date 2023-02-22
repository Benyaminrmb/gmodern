<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['password'] = bcrypt($request->password);


        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return $this->generateResponse(false,false,'ایمیل یا رمز اشتباه است',401);
        }


        $token = auth()->user()->createToken('API Token')->accessToken;

        return $this->generateResponse(['user' => auth()->user(), 'token' => $token]);
    }

    public function getUser()
    {
        $user=Auth::user();
        return $this->generateResponse($user);
    }
}
