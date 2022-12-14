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



        Session::put('TempUserEmail', request('email'));
        $user->save();

            return view('auth.securityQuestion');
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

                        return redirect('home');
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

    public function submitQuestion(Request $request){
        if(Session::has('TempUserEmail')){
            $email = Session::get('TempUserEmail');
            $user = User::where('email', $email);
            $request->validate([
                'question' => 'required',
                'answer' => 'required'
            ]);
            $user->update([
                'question' => $request->question,
                'answer' => Hash::make(request('answer')),
            ]);

            Session::pull('TempUserEmail');

            return redirect('login')->with('success', 'You are now officially registered please log in with your credentials');
        }
        else{
            return back()->with('fail', 'something went wrong');
      }
    }

    public function pwdResetView(){
        return view('auth.resetForm');
    }

    public function askSecurityQuestion(Request $request){
        request()->validate([
            'email'=>'required'
        ]);



        $user = User::get()->where('email', $request->email)->first();

        if ($user){
            Session::put('resetUser', $user->email);

            $question = $user->question;

            return view('auth.askQuestion', compact('question'));
        }
    }

    public function newPasswordView(Request $request){

        $request->validate([
            'answer'=>'required'
        ], [
            'answer.required'=>'make sure your spelling is correct'
        ]);

        $user = User::get()->where('email', Session::get('resetUser'))->first();

        if (Hash::check($request->answer, $user->answer)){
            $email = $user->email;

            return view('auth.newPwd', compact('email'));
        }
        else{
            return back()->with('fail', 'wrong answer. Make sure that your spelling is correct');
        }

    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => ['required',  Password::defaults()->symbols()->mixedCase()->letters()->numbers()],
            'confirm-password'=> ['required', 'same:password']
        ]);

        $password = $request->password;

        $user = User::get()->where('email', Session::get('resetUser'))->first();

        $user->update([
            'password'=> Hash::make($password)
        ]);

        Session::pull('resetUser');

        return redirect('login')->with('success', 'password successfully resetted');
    }
}
