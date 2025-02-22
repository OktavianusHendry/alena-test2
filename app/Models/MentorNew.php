<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MentorNew extends Authenticatable
{
    use Notifiable;

    protected $table = 'mentor';

    protected $fillable = [
        'nip', 'nama_lengkap', 'email', 'password', 'jabatan', 'divisi', 'nik', 'tempat_lahir', 'tanggal_lahir', 'foto', 'no_hp', 'alamat', 'tanggal_bergabung', 'status', 'email_verified_at', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
