@extends('layouts.app-warga')

@section('title', 'Profil Saya')

@section('content')
    <div class="profile-layout" style="max-width: 1250px; margin: 0 auto; padding: 20px;">
        <div class="header-section" style="margin-bottom: 30px;">
            <h2 style="font-family: 'Domine'; color: var(--color-1);">Manajemen Data Keluarga</h2>
            <p>Kelola anggota keluarga Anda untuk mempermudah administrasi desa.</p>
        </div>

        @if(session('success'))
            <div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-container" style="display: flex; gap: 30px; align-items: stretch; flex-wrap: wrap;">

                <div class="profile-info-side" style="flex: 1.2; min-width: 380px;">
                    <div class="info-card"
                        style="background: var(--color-2); color: white; padding: 40px 30px; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; display: flex; flex-direction: column; box-sizing: border-box;">

                        <div class="user-avatar-section" style="text-align: center; margin-bottom: 30px;">
                            <div class="image-wrapper" style="position: relative; display: inline-block;">
                                <img src="{{ $user->foto ? asset('storage/' . $user->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama_lengkap) . '&background=ffffff&color=48B3AF' }}"
                                    class="avatar" id="preview-foto"
                                    style="width: 130px; height: 130px; border-radius: 50%; border: 5px solid rgba(255,255,255,0.2); object-fit: cover; background: white;">

                                <label for="input-foto" class="btn-change-photo"
                                    style="position: absolute; bottom: 5px; right: 5px; background: #3a918e; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 3px solid white; transition: 0.3s;">
                                    <i class="fas fa-camera" style="color: white; font-size: 15px;"></i>
                                </label>
                                <input type="file" name="foto" id="input-foto" hidden accept="image/*"
                                    onchange="previewImage(this)">
                            </div>
                            <h3 style="margin: 15px 0 5px 0; font-size: 22px; font-weight: 700;">{{ $user->nama_lengkap }}
                            </h3>
                            <div style="font-size: 13px; opacity: 0.9; font-family: monospace;">NIK: {{ $user->nik }}</div>
                        </div>

                        <div class="info-scroller" style="flex-grow: 1; overflow-y: auto; padding-right: 5px;">

                            <div class="info-group-title">Identitas & Kontak</div>
                            <div class="info-item-box">
                                <div class="info-row"><span>No. KK:</span> <strong>{{ $user->no_kk ?? '-' }}</strong></div>
                                <div class="info-row"><span>Email:</span> <strong>{{ $user->email ?? '-' }}</strong></div>
                                <div class="info-row"><span>No. HP:</span> <strong>{{ $user->no_hp ?? '-' }}</strong></div>
                            </div>

                            <div class="info-group-title">Detail Personal</div>
                            <div class="info-item-box">
                                <div class="info-row"><span>TTL:</span> <strong>{{ $user->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') }}</strong></div>
                                <div class="info-row"><span>Gender:</span>
                                    <strong>{{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong>
                                </div>
                                <div class="info-row"><span>Agama:</span> <strong>{{ $user->agama }}</strong></div>
                                <div class="info-row"><span>Pekerjaan:</span> <strong>{{ $user->pekerjaan }}</strong></div>
                                <div class="info-row"><span>Status:</span> <strong>{{ $user->status_perkawinan }}</strong>
                                </div>
                                <div class="info-row"><span>Warga Negara:</span>
                                    <strong>{{ $user->kewarganegaraan }}</strong>
                                </div>
                            </div>

                            <div class="info-group-title">Alamat Domisili</div>
                            <div class="info-item-box">
                                <div class="info-row"><span>Jalan/Dusun:</span> <strong>{{ $user->alamat_jalan }}</strong>
                                </div>
                                <div class="info-row"><span>RT/RW:</span> <strong>{{ $user->rt_rw }}</strong></div>
                                <div class="info-row"><span>Kel/Desa:</span> <strong>{{ $user->kel_desa }}</strong></div>
                                <div class="info-row"><span>Kecamatan:</span> <strong>{{ $user->kecamatan }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-form-side" style="flex: 2; min-width: 450px;">
                    <div class="form-card"
                        style="background: white; padding: 40px; border-radius: 25px; box-shadow: 0 5px 30px rgba(0,0,0,0.05); height: 100%; box-sizing: border-box;">
                        <h2
                            style="font-family: 'Domine'; color: var(--color-1); margin: 0 0 30px 0; display: flex; align-items: center; gap: 15px; font-size: 24px;">
                            <i class="fas fa-edit"></i> Edit Data Profil
                        </h2>

                        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                            <div class="form-group" style="grid-column: span 2;">
                                <label>Nama Lengkap (Sesuai Identitas)</label>
                                <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required>
                            </div>

                            <div class="form-group">
                                <label>Nomor Kartu Keluarga (KK)</label>
                                <input type="text" name="no_kk" value="{{ $user->no_kk }}" maxlength="16">
                            </div>

                            <div class="form-group">
                                <label>Nomor HP / WhatsApp</label>
                                <input type="text" name="no_hp" value="{{ $user->no_hp }}">
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ $user->tempat_lahir }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}" required>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin">
                                    <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Agama</label>
                                <select name="agama">
                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agm)
                                        <option value="{{ $agm }}" {{ $user->agama == $agm ? 'selected' : '' }}>{{ $agm }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status Perkawinan</label>
                                <select name="status_perkawinan">
                                    @foreach(['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati'] as $stat)
                                        <option value="{{ $stat }}" {{ $user->status_perkawinan == $stat ? 'selected' : '' }}>
                                            {{ $stat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pekerjaan Saat Ini</label>
                                <input type="text" name="pekerjaan" value="{{ $user->pekerjaan }}" required>
                            </div>

                            <div class="form-group">
                                <label>Kewarganegaraan</label>
                                <select name="kewarganegaraan">
                                    <option value="WNI" {{ $user->kewarganegaraan == 'WNI' ? 'selected' : '' }}>WNI</option>
                                    <option value="WNA" {{ $user->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Alamat Email</label>
                                <input type="email" name="email" value="{{ $user->email }}">
                            </div>

                            <div class="form-group" style="grid-column: span 2;">
                                <label>Alamat Jalan / Dusun</label>
                                <input type="text" name="alamat_jalan" value="{{ $user->alamat_jalan }}" required>
                            </div>

                            <div class="form-group">
                                <label>RT / RW</label>
                                <input type="text" name="rt_rw" value="{{ $user->rt_rw }}" required placeholder="001/002">
                            </div>

                            <div class="form-group">
                                <label>Kelurahan / Desa</label>
                                <input type="text" name="kel_desa" value="{{ $user->kel_desa }}" required>
                            </div>

                            <div class="form-group" style="grid-column: span 2;">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" value="{{ $user->kecamatan }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i> Update Profil Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('extra-style')
    <style>
        /* CSS untuk Info Side agar rapi */
        .info-group-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin: 20px 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            opacity: 0.8;
        }

        .info-item-box {
            background: rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 5px;
        }

        .info-row span {
            opacity: 0.7;
            font-weight: 400;
        }

        .info-row strong {
            font-weight: 600;
            text-align: right;
        }

        /* Style Form */
        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: #777;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #eee;
            border-radius: 12px;
            font-size: 14px;
            transition: 0.3s;
            box-sizing: border-box;
            background: #fdfdfd;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--color-1);
            outline: none;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(72, 179, 175, 0.1);
        }

        .btn-update {
            width: 100%;
            padding: 16px;
            background: var(--color-2);
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 30px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 8px 15px rgba(58, 145, 142, 0.2);
        }

        .btn-update:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(58, 145, 142, 0.3);
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-left: 5px solid #198754;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .profile-container {
                flex-direction: column;
            }
        }
    </style>
@endsection

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-foto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>