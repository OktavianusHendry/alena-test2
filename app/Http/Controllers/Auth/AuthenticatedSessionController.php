<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KaryawanNew; // Import model KaryawanNew

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('web')->user());
        }

        // Coba login sebagai karyawan
        if (Auth::guard('karyawan')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('karyawan')->user());
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request)
    {
        // Logout dari guard yang sedang aktif
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        // Jika login sebagai karyawan
        if (Auth::guard('karyawan')->check()) {
            // Redirect berdasarkan jabatan (role) karyawan
            switch ($user->jabatan) {
                case '10': // Staff
                    return redirect()->route('staff.dashboard')->with('status', 'Welcome to your dashboard');
                case '11': // Manager
                    return redirect()->route('manager.dashboard')->with('status', 'Welcome to your dashboard');
                // Tambahkan case lain sesuai kebutuhan
                default:
                    return redirect()->route('karyawan.dashboard')->with('status', 'Welcome to your dashboard');
            }
        }

        // Jika login sebagai user biasa atau admin
        if ($user->role_as == '1') { // 1 = Admin
            return redirect()->route('admin.dashboard')->with('status', 'Welcome to your dashboard');
        }
        if ($user->role_as == '2') { // 2 = Crew
            return redirect()->route('crew.dashboard')->with('status', 'Welcome to your dashboard');
        }
        if ($user->role_as == '0') { // 0 = User Biasa
            return redirect()->route('user.dashboard')->with('status', 'Welcome to your dashboard');
        }

        // Default redirect
        return redirect('/')->with('status', 'Logged in successfully');
    }
}
