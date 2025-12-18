@extends('layouts.app-admin')

@section('title', 'Data Penduduk')

@section('content')
    <div class="welcome-card-2">
        <h1>Manajemen Data Penduduk</h1>
        <p>Terdapat <span class="badge bg-primary">{{ $totalWarga }}</span> warga sudah tercatat dari <span
                class="badge bg-success"> {{ $totalKeluarga }}</span> Kepala Keluarga</p>
    </div>

    <div class="container-fluid p-4 main-content-bg">
        {{-- 3 CHARTS --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 chart-card-wrapper">
                    <h6 class="text-muted fw-bold small text-uppercase mb-3">Gender</h6>
                    <div class="chart-box"><canvas id="genderChart"></canvas></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 chart-card-wrapper">
                    <h6 class="text-muted fw-bold small text-uppercase mb-3">Status Perkawinan</h6>
                    <div class="chart-box"><canvas id="nikahChart"></canvas></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 chart-card-wrapper">
                    <h6 class="text-muted fw-bold small text-uppercase mb-3">Kelompok Usia</h6>
                    <div class="chart-box"><canvas id="ageChart"></canvas></div>
                </div>
            </div>
        </div>

        {{-- FILTER & ACTION --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ route('admin.penduduk') }}" method="GET" id="filterForm" class="row g-2">
                    <div class="col-md-4">
                        <label class="small text-muted fw-bold">Pencarian</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari NIK, Nama, atau KK..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="small text-muted fw-bold">Urutan</label>
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="nik" {{ request('sort') == 'nik' ? 'selected' : '' }}>NIK</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="small text-muted fw-bold">Tampilkan</label>
                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                            @foreach([10, 20, 50, 100, 200] as $size)
                                <option value="{{ $size }}" {{ request('per_page') == $size ? 'selected' : '' }}>{{ $size }} data
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-filter flex-grow-1">Filter</button>
                        <button type="button" class="btn btn-success" onclick="openDownloadModal()">
                            <i class="fas fa-download"></i>
                        Download
                            </button>
                            <a href="{{ route('admin.penduduk') }}" class="btn btn-outline-secondary"><i class="fas fa-sync"></i></a>
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
                                    <th class="ps-3">No</th>
                                    <th>No. KK</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>WhatsApp</th>
                                    <th class="text-center pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($warga as $item)
                                    <tr>
                                        <td class="ps-3">{{ $loop->iteration + $warga->firstItem() - 1 }}</td>
                                        <td class="text-monospace">{{ $item->no_kk_masked ?? $item->no_kk }}</td>
                                        <td class="text-monospace">{{ $item->nik_masked ?? $item->nik }}</td>
                                        <td class="fw-bold">{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->no_hp ?? '-' }}</td>
                                        <td class="text-center pe-3">
                                            <button class="btn btn-sm btn-info text-white" onclick="showDetail('{{ $item->nik }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="{{ route('penduduk.destroy', $item->nik) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center py-5 text-muted">Data tidak ditemukan</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-between align-items-center mt-4 pb-5">
                <div class="text-muted small">
                    Menampilkan {{ $warga->firstItem() ?? 0 }} - {{ $warga->lastItem() ?? 0 }} dari {{ $warga->total() }} data
                </div>
                <div class="pagination-wrapper">
                    {{ $warga->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        {{-- MODAL DETAIL --}}
        <div id="wargaModal" class="custom-modal">
            <div class="modal-content-box shadow-lg" style="max-width: 500px;">
                <div class="modal-header-custom p-3 d-flex justify-content-between align-items-center text-white">
                    <h6 class="mb-0 fw-bold">Detail Penduduk</h6>
                    <button class="btn-close btn-close-white" onclick="closeWargaModal()"></button>
                </div>
                <div class="modal-body-custom p-4" id="modalContent"></div>
            </div>
        </div>

        {{-- MODAL DOWNLOAD --}}
        <div id="downloadModal" class="custom-modal">
            <div class="modal-content-box shadow-lg" style="max-width: 450px;">
                <div class="modal-header-custom p-3 text-white">
                    <h6 class="mb-0 fw-bold">Pengaturan Download</h6>
                    <button class="btn-close btn-close-white" onclick="closeDownloadModal()"></button>
                </div>
                <form action="{{ route('admin.penduduk.export') }}" method="GET">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <div class="modal-body-custom p-4">
                        <label class="small fw-bold mb-2 d-block text-muted">Pilih Kolom Data:</label>
                        <div class="row g-2">
                            @php $cols = ['nik', 'no_kk', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat_jalan', 'pekerjaan', 'no_hp']; @endphp
                            @foreach($cols as $col)
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $col }}" id="dl_{{ $col }}" checked>
                                        <label class="form-check-label small" for="dl_{{ $col }}">{{ ucwords(str_replace('_', ' ', $col)) }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3 pt-3 border-top">
                            <label class="small fw-bold mb-1 d-block text-muted">Format File:</label>
                            <select name="format" class="form-select form-select-sm">
                                <option value="xlsx">Excel (.xlsx)</option>
                                <option value="csv">CSV (.csv)</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-3 bg-light text-end">
                        <button type="submit" class="btn btn-primary btn-sm px-4">Download Sekarang</button>
                    </div>
                </form>
            </div>
        </div>

        <style>
            .main-content-bg { background: #f8f9fa; min-height: 100vh; }
            .chart-box { height: 180px; }
            .btn-filter { background-color: #476eae; color: white; border: none; }
            .btn-filter:hover { background-color: #3a5a8f; color: white; }

            /* Pagination Styling */
            .pagination .page-link { border: none; color: #476eae; margin: 0 2px; border-radius: 6px; padding: 8px 14px; }
            .pagination .page-item.active .page-link { background-color: #476eae; color: white !important; }

            /* Modal System */
            .custom-modal { 
                display: none; position: fixed; inset: 0; 
                background: rgba(0,0,0,0.5); z-index: 1050; 
                backdrop-filter: blur(2px);
            }
            .modal-content-box { background: #fff; margin: 10vh auto; border-radius: 12px; overflow: hidden; }
            .modal-header-custom { background-color: #476eae; }
            .modal-body-custom { max-height: 70vh; overflow-y: auto; }
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
                        backgroundColor: ['#476eae', '#f6c23e']
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
                        backgroundColor: '#476eae'
                    }]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { display: false } } }
            });
        });

        function showDetail(nik) {
            const modal = document.getElementById('wargaModal');
            const content = document.getElementById('modalContent');
            modal.style.display = 'block';
            content.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';

            fetch(`/admin/${nik}`)
                .then(res => res.json())
                .then(data => {
                    content.innerHTML = `
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless small">
                                <tr><th width="35%" class="text-muted text-uppercase">NIK</th><td>: ${data.nik}</td></tr>
                                <tr><th class="text-muted text-uppercase">No. KK</th><td>: ${data.no_kk || '-'}</td></tr>
                                <tr><th class="text-muted text-uppercase">Nama</th><td>: <strong>${data.nama_lengkap}</strong></td></tr>
                                <tr><th class="text-muted text-uppercase">TTL</th><td>: ${data.tempat_lahir}, ${data.tanggal_lahir}</td></tr>
                                <tr><th class="text-muted text-uppercase">Gender</th><td>: ${data.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</td></tr>
                                <tr><th class="text-muted text-uppercase">Alamat</th><td>: ${data.alamat_jalan || '-'}</td></tr>
                                <tr><th class="text-muted text-uppercase">Pekerjaan</th><td>: ${data.pekerjaan || '-'}</td></tr>
                                <tr><th class="text-muted text-uppercase">WhatsApp</th><td>: ${data.no_hp || '-'}</td></tr>
                            </table>
                        </div>`;
                }).catch(() => {
                    content.innerHTML = '<p class="text-center text-danger">Gagal memuat data.</p>';
                });
        }

        function openDownloadModal() { document.getElementById('downloadModal').style.display = 'block'; }
        function closeDownloadModal() { document.getElementById('downloadModal').style.display = 'none'; }
        function closeWargaModal() { document.getElementById('wargaModal').style.display = 'none'; }

        window.onclick = function(e) {
            if(e.target.className === 'custom-modal') {
                closeWargaModal();
                closeDownloadModal();
            }
        }
    </script>
@endsection