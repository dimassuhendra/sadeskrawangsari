<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'no_surat',
        'warga_nik',
        'jenis_surat',
        'keperluan',
        'status',
        'keterangan_admin',
        'file_hasil'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_nik', 'nik');
    }
}