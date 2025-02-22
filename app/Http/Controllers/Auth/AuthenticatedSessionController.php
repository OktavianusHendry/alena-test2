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
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Coba login sebagai Karyawan
        if (Auth::guard('karyawan')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('karyawan')->user(), 'karyawan');
        }

        // Coba login sebagai Mentor
        if (Auth::guard('mentor')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('mentor')->user(), 'mentor');
        }

        // Coba login sebagai User Biasa (default Laravel)
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('web')->user(), 'web');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    protected function authenticated(Request $request, $user, $guard)
    {
        if ($guard === 'karyawan') {
            return $this->redirectKaryawan($user);
        }

        if ($guard === 'mentor') {
            return redirect()->route('mentor.dashboard')->with('status', 'Welcome Mentor!');
        }

        if ($user->role_as == '1') {
            return redirect()->route('admin.dashboard')->with('status', 'Welcome Admin!');
        } elseif ($user->role_as == '2') {
            return redirect()->route('crew.dashboard')->with('status', 'Welcome Crew!');
        } else {
            return redirect()->route('user.dashboard')->with('status', 'Welcome User!');
        }
    }

    protected function redirectKaryawan($user)
    {
        switch ($user->jabatan) {
            case '1': // Admin
                return redirect()->route('admin.dashboard')->with('status', 'Welcome Admin!');
            case '2': // Staff
                return redirect()->route('staff.dashboard')->with('status', 'Welcome Staff!');
            case '3': // Mentor
                return redirect()->route('mentor.dashboard')->with('status', 'Welcome Mentor!');
            case '4': // Manager
                return redirect()->route('manager.dashboard')->with('status', 'Welcome Manager!');
            case '5': // Kepala Academy
                return redirect()->route('kepala_academy.dashboard')->with('status', 'Welcome Kepala Academy!');
            case '6': // Wakil Direktur
                return redirect()->route('wakil_direktur.dashboard')->with('status', 'Welcome Wakil Direktur!');
            case '7': // Direktur
                return redirect()->route('direktur.dashboard')->with('status', 'Welcome Direktur!');
            default:
                return redirect()->route('karyawan.dashboard')->with('status', 'Welcome Karyawan!');
        }
    }

    public function destroy(Request $request)
    {
        // Logout dari semua guard yang sedang aktif
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }
        if (Auth::guard('mentor')->check()) {
            Auth::guard('mentor')->logout();
        }
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

