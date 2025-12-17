<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Warga;

class ProfileWargaController extends Controller
{
    public function index()
    {
        $user = Auth::guard('warga')->user();
        return view('warga.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('warga')->user();

        $request->validate([
            'nama_lengkap' => 'required|max:150',
            'no_kk' => 'nullable|max:16',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_jalan' => 'required|max:255',
            'rt_rw' => 'required|max:10',
            'kel_desa' => 'required|max:100',
            'kecamatan' => 'required|max:100',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu', // Sesuai SQL
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati', // Sesuai SQL
            'pekerjaan' => 'required|max:100',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'no_hp' => 'nullable|max:15',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi Foto
        ]);

        $data = $request->except(['_token', 'foto']);

        // Logika Upload Foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/img/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            $fileName = time() . '_' . $user->nik . '.' . $request->foto->extension();
            $path = $request->file('foto')->storeAs('foto_profil', $fileName, 'public');
            $data['foto'] = $path;
        }

        Warga::where('nik', $user->nik)->update($data);

        return back()->with('success', 'Profil dan foto berhasil diperbarui!');
    }
}