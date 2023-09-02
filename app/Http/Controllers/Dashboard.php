<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
    {
        if (Auth::user()->account_type === 'student') {
            if (Auth::user()->section_id == null ) {
                return redirect()->route('pickSection');
            }

            return view('dashboard.student');
        }

        return view('dashboard.dashboard');
    }
}
