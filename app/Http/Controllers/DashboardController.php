<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboard(){

        $data = array();

        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard.main', compact('data'));
    }

    public function profile(){
        $data = array();

        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard.profile', compact('data'));
    }
    public function board(){
        $data = array();

        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard.board', compact('data'));
    }
}
