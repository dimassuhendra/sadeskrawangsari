<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterWargaController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-warga');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'email' => 'required|email|unique:warga,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'nik.digits' => 'NIK harus berjumlah 16 digit.',
            'email.unique' => 'Email sudah digunakan.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // MENGGUNAKAN updateOrCreate: 
        // Jika NIK ditemukan, maka email & password diupdate (aktivasi).
        // Jika NIK tidak ditemukan, maka baris baru akan dibuat (otomatis tambah data warga).
        Warga::updateOrCreate(
            ['nik' => $request->nik], // Cari berdasarkan NIK
            [
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nama_lengkap' => $request->nama_lengkap ?? 'Warga Baru',
                'tempat_lahir' => $request->tempat_lahir ?? 'Indonesia',
                'tanggal_lahir' => $request->tanggal_lahir ?? '1991-01-01',
                'jenis_kelamin' => $request->jenis_kelamin ?? 'P',
                'alamat_jalan' => $request->alamat_jalan ?? 'Indonesia',
                'rt_rw' => $request->rt_rw ?? '01/01',
                'kel_desa' => $request->kel_desa ?? 'Indonesia',
                'kecamatan' => $request->kecamatan ?? 'Indonesia',
                'agama' => $request->agama ?? 'Islam',
                'status_perkawinan' => $request->status_perkawinan ?? 'Belum Kawin',
                'pekerjaan' => $request->pekerjaan ?? 'Belum ada pekerjaan'
            ]
        );

        return redirect()->route('login-warga')->with('success', 'Akun berhasil didaftarkan! Silahkan login.');
    }
}