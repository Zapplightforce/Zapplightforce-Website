<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;


class CustomAuthController extends Controller
{

    public function login() {

        return view('auth.login');
    }

    public function registration() {
        return view('auth.registration');
    }

    public function pwdReset(){
        return view('auth.pwdReset');
    }

    public function registerUser() {

        request()->validate([
            'first-name'=>'required',
            'last-name'=>'required',
            'email'=> ['required', 'email', 'unique:users'],
            'password' => ['required',  Password::defaults()->symbols()->mixedCase()->letters()->numbers()],
            'confirm-password'=> ['required', 'same:password']
        ], [
            'password.required'=>'Maybe try using a password manager.'
        ]);

        $user = new User();
        $user->first_name = request('first-name');
        $user->last_name = request('last-name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));

        $user->save();

        return redirect('login')->with('success', 'Your are registered. Please login with your email and password');
    }

    public function loginUser(Request $request)
    {
        $key = 'login.' .$request->ip();



        $request->validate([
            'email'=> ['required', 'email'],
            'password' => ['required',  Password::defaults()->symbols()->mixedCase()->letters()->numbers()]
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if($user){
                if(Hash::check($request->password, $user->password)){
                    $request->session()->put('loginId', $user->id);

                        if($request->has('remember-me')){
                            Cookie::queue('user', $request->email, 1440);
                            Cookie::queue('userpwd', $request->password, 1440);
                        }
                            RateLimiter::clear($key);

                        return redirect('dashboard');
                }else{
                    return back()->with('fail', 'Incorrect password');
                }
        }else{
            return back()->with('fail', 'This email is not registered');
        }
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }if(!Session::has('loginId')){
            return redirect('login');
        }
    }


}
