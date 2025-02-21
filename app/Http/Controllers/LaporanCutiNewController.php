<?php
// app/Http/Controllers/LaporanCutiNewController.php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jenis_Cuti;
use App\Models\LaporanCutiNew;
use Illuminate\Http\Request;

class LaporanCutiNewController extends Controller
{
    public function index(Request $request)
    {
        $karyawans = Karyawan::all();
        $jenisCutis = Jenis_Cuti::all();
        $cutis = LaporanCutiNew::with('karyawan')->get();

        // Mengambil laporan cuti dengan paginasi
        $laporanCutis = LaporanCutiNew::with('karyawan')->paginate(10); // Ganti 10 dengan jumlah item per halaman yang diinginkan

        return view('laporan_cuti_new.index', compact('karyawans', 'jenisCutis', 'laporanCutis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_karyawan' => 'required',
            'id_jenis_cuti' => 'required',
            'tanggal_pengajuan' => 'required|date',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'alasan' => 'required|string',
        ]);

        // Membuat laporan cuti baru
        LaporanCutiNew::create($request->all());

        // Redirect ke index dengan pesan sukses
        return redirect()->route('laporan_cuti_new.index')->with('success', 'Laporan cuti berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        // Mencari laporan cuti berdasarkan ID
        $laporanCuti = LaporanCutiNew::find($id);

        // Jika laporan cuti tidak ditemukan, redirect dengan pesan error
        if (!$laporanCuti) {
            return redirect()->route('laporan_cuti_new.index')->with('error', 'Laporan cuti tidak ditemukan!');
        }

        // Validasi input untuk update
        $request->validate([
            'approved_by_director' => 'required|in:pending,approved,rejected',
            'approved_by_manager' => 'required|in:pending,approved,rejected',
        ]);

        // Update laporan cuti
        $laporanCuti->update($request->all());

        // Redirect ke index dengan pesan sukses
        return redirect()->route('laporan-cuti-new.index')->with('success', 'Laporan cuti berhasil diupdate!');
    }

    public function show($id)
    {
        // Mencari laporan cuti berdasarkan ID
        $laporanCutis = LaporanCutiNew::with(['karyawan', 'Jenis_cuti'])->findOrFail($id);

        // Mengembalikan view dengan data laporan cuti
        return view('laporan_cuti_new.show', compact('laporanCutis'));
    }

    
}