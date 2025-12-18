@extends('layouts.app-admin')

@section('title', 'Data Penduduk')

@section('content')
    <div class="welcome-card-2">
        <h1>Data Penduduk</h1>
        <p> Panel ini memberikan ringkasan aktivitas layanan Desa Krawang Sari hari ini.</p>
    </div>
    <div class="content-section">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($warga as $w)
                        <tr>
                            <td><code>{{ $w->nik }}</code></td>
                            <td><strong>{{ $w->nama_lengkap }}</strong><br><small class="text-muted">{{ $w->email }}</small>
                            </td>
                            <td>{{ $w->jenis_kelamin }}</td>
                            <td>{{ $w->pekerjaan }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('penduduk.show', $w->nik) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('penduduk.destroy', $w->nik) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data penduduk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $warga->links() }}
        </div>
    </div>
@endsection