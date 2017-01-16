<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class PagesController extends Controller
{
    public function homepage(){
    	return view("pages.homepage");
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
