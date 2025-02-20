<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanCutiNew extends Model
{
    use HasFactory;

    protected $table = 'tbl_laporan_cuti'; // Sesuai dengan nama tabel

    protected $fillable = [
        'id_karyawan',
        'id_jenis_cuti',
        'tanggal_pengajuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'approved_by_director',
        'approved_by_manager'
    ];

    // Relasi ke tabel karyawan (tanpa foreign key di DB, hanya untuk query di Laravel)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Relasi ke tabel jenis_cuti (tanpa foreign key di DB, hanya untuk query di Laravel)
    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'id_jenis_cuti');
    }
}
