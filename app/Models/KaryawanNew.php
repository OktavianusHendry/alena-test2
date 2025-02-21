<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KaryawanNew extends Authenticatable
{
    use Notifiable;

    protected $table = 'karyawan';

    protected $fillable = [
        'nip', 'nama_lengkap', 'email', 'password', 'jabatan', 'divisi', 'nik', 'tempat_lahir', 'tanggal_lahir', 'foto', 'no_hp', 'alamat', 'email_verified_at', 'remember_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cuti()
    {
        return $this->hasMany(LaporanCutiNew::class, 'id_karyawan', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id'); // Assuming 'user_id' is the foreign key in the karyawan table
    }
    
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id');
    }
}