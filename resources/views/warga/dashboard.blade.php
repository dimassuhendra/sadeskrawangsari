@extends('layouts.app-warga')

@section('title', 'Dashboard Warga')

@section('extra-style')
    .welcome-card {
    background: linear-gradient(to right, var(--color-2), #3a918e);
    color: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    }

    .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
    }

    .stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    gap: 15px;
    }

    .stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    }

    .content-section {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .btn-request {
    background-color: var(--color-2);
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    float: right;
    }
@endsection

@section('content')
    <div class="welcome-card">
        <h1>Halo, {{ $user->nama_lengkap }}!</h1>
        <p>Selamat datang di sistem layanan mandiri Desa Krawang Sari. NIK Anda: {{ $user->nik }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #476EAE;"><i class="fas fa-folder"></i></div>
            <div><small>Total Pengajuan</small>
                <h3>{{ $stats['total'] }}</h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #f39c12;"><i class="fas fa-clock"></i></div>
            <div><small>Sedang Diproses</small>
                <h3>{{ $stats['proses'] }}</h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #27ae60;"><i class="fas fa-check-circle"></i></div>
            <div><small>Selesai</small>
                <h3>{{ $stats['selesai'] }}</h3>
            </div>
        </div>
    </div>

    <div class="content-section">
        <a href="#" class="btn-request">+ Ajukan Surat Baru</a>
        <h2 style="font-family: 'Domine'; color: var(--color-1);">Pengumuman Desa</h2>
        <hr style="margin: 15px 0; border: 0.5px solid #eee;">

        @forelse($berita as $item)
            <div style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px dashed #ddd;">
                <h4 style="color: var(--color-2);">{{ $item->judul }}</h4>
                <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
            </div>
        @empty
            <p>Belum ada pengumuman terbaru.</p>
        @endforelse
    </div>
@endsection