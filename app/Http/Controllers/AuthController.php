<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\UserRole as ModelsUserRole;

class AuthController extends Controller
{
    public function registerLayout() {
        return view('auth/register');
    }

    public function registerUser(Request $request) {
        $email = $request->post('email');
        $name = $request->post('name');
        $password = $request->post('password');
        $repeaPassword = $request->post('repeat-password');

        $uid = generateRandomString('0123456789');
        $display_name = 'User ' . $uid;

        if ($password != $repeaPassword) {
            return redirect()->back()->with('message', 'Passwords are not the same');;
        }

        $request->validate([
            'email' => 'required|unique:users|email',
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'uid' => $uid,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'display_name' => $display_name
        ]);

        $user_role = new ModelsUserRole();
        $check_user_role = $user_role->cretaeUserRole($user);

        //  nếu lf false thì ne xóa User vừa tạo
        if ($check_user_role == true) {
            auth()->login($user);

            return redirect()->route('dashboards.index');
        } else {
            return redirect()->back();
        }
    }

    public function loginLayout() {
        return view('auth/login');
    }

    public function loginUser(LoginRequest $request) {
        $login = [
            'email' => $request->post('email'),
            'password' => $request->post('password'),
        ];

        if (Auth::attempt($login)) {
            $user = Auth::user();

            auth()->login($user);

            return redirect()->route('dashboards.index');
        } else {
            return redirect()->back()->with('message', 'Email or Password is incorrect');
        }
    }

    public function logoutUser() {
        Auth::logout();
        return redirect()->route('login.layout');
    }
}
