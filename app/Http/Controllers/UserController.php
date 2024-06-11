<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function view_signup() {
        return view('register');
    }

    public function view_signin() {
        return view('login');
    }

    public function show_home(Request $request) {
        $user = $request->session()->get('user');
        return view('dashboard', (['users' => $user]));
    }
    
    public function send_credential(Request $request) {

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $new_user = new User;
        $new_user->email = $validate['email'];
        $new_user->password = $validate['password'];
        $new_user->name = $validate['name'];
        $new_user->save();

        return redirect('register')->with('status', 'Your account has been created');
    }

    public function login(Request $request) {
        $email_req = $request->email;
        $user = User::where('email', $email_req)->first();

            if ($user && Hash::check($request->password, $user->password)) {

                $request->session()->put('user', $user);
                $email = $user->email;
                $username = substr($email, 0, strpos($email, '@'));
    
                return redirect("../blog/{$username}");
            } else {
                return redirect('login')->withErrors(['email' => 'Invalid email or password']);
            }
    }

    public function logout(Request $request) {
        // $request->session()->forget('user');
        $request->session()->flush();
        return redirect('login')->with('status', 'You have been logged out');
    }
}



$new_user = new User;
$new_user->email = $request->email;
$new_user->password = $request->password;
$new_user->name = "cand";
$new_user->save();

              // return redirect('../register')->with('status', 'youre login');
                // return view('dashboard', ['user' => $user]);