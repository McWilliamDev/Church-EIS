<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.dashboard', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.dashboard', $data);
            }
        }
    }
}
