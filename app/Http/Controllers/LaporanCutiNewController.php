<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanCutiNew;

class LaporanCutiNewController extends Controller
{
    // Menampilkan semua pengajuan cuti
    public function index()
    {
        $laporanCuti = LaporanCutiNew::all();
        return response()->json($laporanCuti);
    }

    // Menyimpan pengajuan cuti baru
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|integer',
            'id_jenis_cuti' => 'required|integer',
            'tanggal_pengajuan' => 'required|date',
            'tanggal_mulai' => 'required|date|after_or_equal:tanggal_pengajuan',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        $cuti = LaporanCutiNew::create($request->all());

        return response()->json([
            'message' => 'Pengajuan cuti berhasil dibuat',
            'data' => $cuti
        ], 201);
    }

    // Menampilkan detail pengajuan cuti tertentu
    public function show($id)
    {
        $cuti = LaporanCutiNew::find($id);
        if (!$cuti) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($cuti);
    }

    // Update persetujuan cuti oleh direktur atau manager
    public function updateApproval(Request $request, $id)
    {
        $request->validate([
            'approved_by_director' => 'nullable|in:pending,approved,rejected',
            'approved_by_manager' => 'nullable|in:pending,approved,rejected'
        ]);

        $cuti = LaporanCutiNew::find($id);
        if (!$cuti) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $cuti->update($request->only(['approved_by_director', 'approved_by_manager']));

        return response()->json([
            'message' => 'Status persetujuan berhasil diperbarui',
            'data' => $cuti
        ]);
    }

    // Menghapus pengajuan cuti
    public function destroy($id)
    {
        $cuti = LaporanCutiNew::find($id);
        if (!$cuti) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $cuti->delete();
        return response()->json(['message' => 'Pengajuan cuti berhasil dihapus']);
    }
}
