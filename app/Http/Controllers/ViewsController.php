<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function welcome(){
        if(Auth::check()){
            return redirect()->route('dashboard-reports');}
             return view('welcome');
    }


}
