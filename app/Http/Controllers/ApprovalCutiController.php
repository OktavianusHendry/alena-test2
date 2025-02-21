<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class ApprovalCutiController extends Controller
{
    public function __construct()
    {
        // Middleware hanya untuk Direktur & Manager
        $this->middleware('jabatan.approval');
    }

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);

        $user = Auth::user();
        $jabatan = $user->karyawan->jabatan;

        if ($jabatan == 20) {
            // Direktur menyetujui cuti
            $cuti->approved_by_director = 'approved';
        } elseif ($jabatan == 11) {
            // Manager menyetujui cuti
            $cuti->approved_by_manager = 'approved';
        }

        $cuti->save();
        return redirect()->back()->with('success', 'Cuti telah disetujui.');
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);

        $user = Auth::user();
        $jabatan = $user->karyawan->jabatan;

        if ($jabatan == 20) {
            $cuti->approved_by_director = 'rejected';
        } elseif ($jabatan == 10) {
            $cuti->approved_by_manager = 'rejected';
        }

        $cuti->save();
        return redirect()->back()->with('error', 'Cuti telah ditolak.');
    }
}
