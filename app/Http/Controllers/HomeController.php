<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (! Auth::guest()){
            if (auth()->user()->user_type == config('studentbox.user_type.normal')){
                return view('frontend.index');
            }

            if (auth()->user()->user_type == config('studentbox.user_type.agent')){
                return view('admin.dashboard.index');
            }
        }

        return view('frontend.index');
    }
}
