<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanCutiNew extends Model
{
    use HasFactory;

    protected $table = 'tbl_laporan_cuti';

    protected $fillable = [
        'id_karyawan',
        'id_jenis_cuti',
        'tanggal_pengajuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'approved_by_director',
        'approved_by_manager',
    ];

    public function karyawan()
    {
        return $this->belongsTo(KaryawanNew::class, 'id_karyawan', 'id'); // Menggunakan 'id_karyawan' di tabel cuti dan 'id' di tabel karyawan
    }

    public function jenis_cuti()
    {
        return $this->belongsTo(Jenis_Cuti::class, 'id_jenis_cuti', 'id_jenis_cuti');
    }
}
