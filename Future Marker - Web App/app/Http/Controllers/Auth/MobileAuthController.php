<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class MobileAuthController extends Controller
{
    public function register()
    {
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => request('name'),
            'role' => request('role'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'image' => "images/user.png",
        ]);

        $token = $user->createToken('MySecret')->accessToken;
        
        

        return response()->json(['token' => $token], 200);
    }

    public function login()
    {
        $credentials = [
            'email' => request('email'),
            'password' => request('password'),
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('MySecret')->accessToken;
            $email = auth()->user()->email;
            $password = auth()->user()->password;
            $role = auth()->user()->role;
            return response()->json(['token' => $token,'email'=>$email,'password'=>$password,"role"=>$role], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

}
