<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Warga extends Authenticatable
{
    use Notifiable;
    protected $table = 'warga';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = 
    ['nik',
    'no_kk',
    'password',
    'nama_lengkap',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'alamat_jalan',
    'rt_rw',
    'kel_desa',
    'kecamatan',
    'agama',
    'status_perkawinan',
    'pekerjaan',
    'email'
    ];
    protected $hidden = ['password', 'remember_token'];
}