<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('karyawan')->check()) {
            return redirect()->route('karyawan.dashboard');
        } elseif (Auth::guard('mentor')->check()) {
            return redirect()->route('mentor.dashboard');
        } elseif (Auth::user()) {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('login');
    }

    public function karyawan()
    {
        return view('dashboard.karyawan');
    }

    public function staff()
    {
        return view('dashboard.staff');
    }

    public function manager()
    {
        return view('dashboard.manager');
    }

    public function kepalaAcademy()
    {
        return view('dashboard.kepala_academy');
    }

    public function wakilDirektur()
    {
        return view('dashboard.wakil_direktur');
    }

    public function direktur()
    {
        return view('dashboard.direktur');
    }

    public function mentor()
    {
        return view('dashboard.mentor');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }

    public function crew()
    {
        return view('dashboard.crew');
    }

    public function user()
    {
        return view('dashboard.user');
    }
}
