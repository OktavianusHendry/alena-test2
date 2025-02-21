<?php
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KaryawanNew;

class JabatanApprovalMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Cek apakah user memiliki data karyawan
        if (!$user || !$user->karyawan) {
            return abort(403, 'Anda tidak memiliki akses.');
        }

        // Ambil jabatan karyawan
        $jabatan = $user->karyawan->jabatan;

        // Hanya Direktur (20) dan Manager (11) yang bisa approve
        if ($jabatan != 20 && $jabatan != 11) {
            return abort(403, 'Anda tidak memiliki izin untuk validasi cuti.');
        }

        return $next($request);
    }
}
