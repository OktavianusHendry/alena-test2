<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard');
    }

    public function tugas()
    {
        // Tambahkan logika untuk tugas staff
        return view('staff.tugas');
    }
}