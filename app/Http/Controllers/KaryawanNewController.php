<?php

namespace App\Http\Controllers;

use App\Models\KaryawanNew;
use Illuminate\Http\Request;

class KaryawanNewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $karyawans = KaryawanNew::where('nama_lengkap', 'like', '%' . $search . '%')->paginate(10);

        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:karyawans',
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:karyawans',
            'jabatan' => 'required',
            'divisi' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $karyawan = new Karyawan($request->all());

        // Handle file upload
        if ($request->hasFile('foto')) {
            $filePath = $request->file('foto')->store('public/fotos');
            $karyawan->foto = basename($filePath);
        }

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.show', compact('karyawan'));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|unique:karyawans,nip,' . $id,
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $id,
            'jabatan' => 'required',
            'divisi' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($request->all());

        // Handle file upload if provided
        if ($request->hasFile('foto')) {
            $filePath = $request->file('foto')->store('public/fotos');
            $karyawan->foto = basename($filePath);
        }

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
