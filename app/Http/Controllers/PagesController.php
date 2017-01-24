<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class PagesController extends Controller
{
    public function entryPointVue(){
    	return view("master");
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
