<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function show_login_form()
    {
        return view('auth.login');
    }

    public function show_register_form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email", "string","unique:users,email"],
            "password" => ["required", "confirmed"]
        ]);

        $user = User::create([
            "name"=> $data["name"],
            "email"=> $data["email"],
            "password" =>bcrypt($data["password"])
        ]);

        if($user){
            auth(guard:"web")->login($user);
        }

        return redirect(route('home'));
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"]
        ]);

        if(auth(guard: "web")->attempt($data)){
            return redirect(route('home'));
        }

        return redirect(route('login'))->withErrors(["password" => "Неверный логин или пароль"]);
    }

    public function logout()
    {
        auth(guard:"web")->logout();
        return redirect(route('home'));
    }
}
