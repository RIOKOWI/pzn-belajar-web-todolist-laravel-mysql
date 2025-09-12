<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function login(): Response
    {
        return response()->view('user.login', [
            "title" => 'Login Bang'
        ]);
    }

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        // kalau salah satu field kosong
        if(empty($user) || empty($password)){
            return response()->view('user.login', [
                "title" => "Login",
                "error" => "User or Password is required"
            ]);
        }

        // proses login
        if($this->userService->login($user, $password)){
            $request->session()->put("user", $user);
            return redirect("/");
        }

        //salah login
        return response()->view('user.login', [
            "title" => "Login",
            "error" => "Username or Password are wrong",
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect("/");
    }
}
