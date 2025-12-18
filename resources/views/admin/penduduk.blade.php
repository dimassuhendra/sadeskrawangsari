@extends('layouts.app-admin')

@section('content')
    <div class="welcome-card-2">
        <h1>Manajemen Data Penduduk</h1>
        <p>Terdapat <span class="badge bg-primary">{{ $totalWarga }}</span> warga sudah tercatat dari <span
                class="badge bg-success"> {{ $totalKeluarga }}</span> Kepala Keluarga</p>
    </div>

    <div class="container-fluid p-4" style="background:#f8f9fa; min-height:100vh;">
        {{-- 3 CHARTS --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 chart-card-wrapper">
                    <h6 class="text-muted fw-bold small text-uppercase mb-3">Gender</h6>
                    <div style="height:180px"><canvas id="genderChart"></canvas></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 chart-card-wrapper">
                    <h6 class="text-muted fw-bold small text-uppercase mb-3">Status Perkawinan</h6>
                    <div style="height:180px"><canvas id="nikahChart"></canvas></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 chart-card-wrapper">
                    <h6 class="text-muted fw-bold small text-uppercase mb-3">Kelompok Usia</h6>
                    <div style="height:180px"><canvas id="ageChart"></canvas></div>
                </div>
            </div>
        </div>

        {{-- FILTER & SEARCH --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ route('admin.penduduk') }}" method="GET" id="filterForm" class="row g-2">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari NIK, Nama, atau Kepala Keluarga..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="sort" class="form-select">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="nik" {{ request('sort') == 'nik' ? 'selected' : '' }}>NIK</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-dark flex-grow-1">Filter</button>
                        {{-- TOMBOL RESET --}}
                        <a href="{{ route('admin.penduduk') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>No. KK</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>WhatsApp</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warga as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $warga->firstItem() - 1 }}</td>
                                    <td class="text-monospace">{{ $item->no_kk_masked }}</td>
                                    <td class="text-monospace">{{ $item->nik_masked }}</td>
                                    <td class="fw-bold">{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->no_hp ?? '-' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info text-white" onclick="showDetail('{{ $item->nik }}')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form action="{{ route('penduduk.destroy', $item->nik) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">{{ $warga->links() }}</div>
    </div>

    {{-- MODAL DETAIL --}}
    <div id="wargaModal" class="custom-modal shadow">
        <div class="modal-content-box shadow-lg">
            <div class="modal-header-custom p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
                <h5 class="mb-0 fw-bold">Profil Lengkap Penduduk</h5>
                <button class="btn btn-close" onclick="closeWargaModal()"></button>
            </div>
            <div class="modal-body-custom p-4" id="modalContent">
                {{-- Konten diisi via AJAX --}}
            </div>
        </div>
    </div>

    <style>
        .custom-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
        }

        .modal-content-box {
            background: #fff;
            margin: 5% auto;
            max-width: 650px;
            border-radius: 12px;
            overflow: hidden;
        }

        .text-monospace {
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('extra-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gender Chart
            new Chart(document.getElementById('genderChart'), {
                type: 'doughnut',
                data: {
                    labels: ['L', 'P'],
                    datasets: [{
                        data: [{{ $genderStats->where('jenis_kelamin', 'L')->first()->total ?? 0 }}, {{ $genderStats->where('jenis_kelamin', 'P')->first()->total ?? 0 }}],
                        backgroundColor: ['#4e73df', '#f6c23e']
                    }]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });

            // Status Nikah Chart
            new Chart(document.getElementById('nikahChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($statusNikahStats->pluck('status_perkawinan')) !!},
                    datasets: [{
                        data: {!! json_encode($statusNikahStats->pluck('total')) !!},
                        backgroundColor: ['#1cc88a', '#e74a3b', '#36b9cc', '#f6c23e']
                    }]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });

            // Age Chart
            new Chart(document.getElementById('ageChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($ageStats->pluck('kelompok_usia')) !!},
                    datasets: [{
                        label: 'Jiwa',
                        data: {!! json_encode($ageStats->pluck('total')) !!},
                        backgroundColor: '#4e73df'
                    }]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { display: false } } }
            });
        });

        // FUNGSI MODAL DETAIL (Perbaikan agar tidak muter-muter)
        function showDetail(nik) {
            const modal = document.getElementById('wargaModal');
            const content = document.getElementById('modalContent');

            modal.style.display = 'block';
            content.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div><p>Mengambil data...</p></div>';

            // Pastikan URL ini sesuai dengan route Anda
            fetch(`/admin/${nik}`)
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengambil data');
                    return response.json();
                })
                .then(data => {
                    content.innerHTML = `
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-sm">
                                                <tr><th width="40%">NIK</th><td>${data.nik}</td></tr>
                                                <tr><th>No. KK</th><td>${data.no_kk || '-'}</td></tr>
                                                <tr><th>Nama Lengkap</th><td><strong>${data.nama_lengkap}</strong></td></tr>
                                                <tr><th>Tempat, Tgl Lahir</th><td>${data.tempat_lahir}, ${data.tanggal_lahir}</td></tr>
                                                <tr><th>Jenis Kelamin</th><td>${data.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</td></tr>
                                                <tr><th>Agama</th><td>${data.agama}</td></tr>
                                                <tr><th>Alamat</th><td>${data.alamat_jalan}, RT/RW ${data.rt_rw}</td></tr>
                                                <tr><th>Pekerjaan</th><td>${data.pekerjaan}</td></tr>
                                                <tr><th>Status Nikah</th><td>${data.status_perkawinan}</td></tr>
                                                <tr><th>WhatsApp</th><td>${data.no_hp || '-'}</td></tr>
                                                <tr><th>Kepala Keluarga</th><td>${data.keluarga ? data.keluarga.nama_kepala_keluarga : '-'}</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                `;
                })
                .catch(error => {
                    content.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
                });
        }

        function closeWargaModal() { document.getElementById('wargaModal').style.display = 'none'; }

        // Close modal when clicking outside
        window.onclick = function (event) {
            if (event.target == document.getElementById('wargaModal')) closeWargaModal();
        }
    </script>
@endsection