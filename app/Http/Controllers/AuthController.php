<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            "email" => ["required", "email", "string", "unique:users,email"],
            "password" => ["required", "confirmed"],
            "timezone" => ["required", "string"]
        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
            "timezone" => $data["timezone"]
        ]);

        if ($user) {
            auth(guard: "web")->login($user);
        }

        return redirect(route('home'));
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"],
            "timezone" => ["required", "string"]
        ]);


        if (auth(guard: "web")->attempt($data)) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            if ($user->timezone != $data['timezone']) {
                $user->timezone = $data['timezone'];
                $user->save();
            }
            return redirect(route('home'));
        }

        return redirect(route('login'))->withErrors(["password" => "Неверный логин или пароль"]);
    }

    public function logout()
    {
        auth(guard: "web")->logout();
        return redirect(route('home'));
    }
}
