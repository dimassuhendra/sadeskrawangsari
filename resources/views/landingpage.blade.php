<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantor Desa Krawang Sari</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style-warga.css') }}">
</head>
<body>

    @include('partials.navbar')

    <div class="content-container">
        
        <section class="mb-5">
            <h2>Visi & Misi Desa</h2>
            @if(isset($visi_misi) && $visi_misi != null)
                <div class="konten-text">
                    {!! $visi_misi !!} 
                </div>
            @else
                <p class="text-muted"><em>Konten Visi & Misi belum tersedia.</em></p>
            @endif
        </section>

        <hr>

        <section class="mt-5">
            <h2>Pengumuman Terbaru</h2>
            @if(isset($berita) && $berita->count() > 0)
                <div class="grid-berita">
                    @foreach($berita as $item)
                        <div class="card-berita">
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ Str::limit($item->isi, 150) }}</p>
                            <a href="#">Baca Selengkapnya</a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert-info">
                    <p>Konten pengumuman belum tersedia.</p>
                </div>
            @endif
        </section>

    </div>

    @include('partials.footer')

</body>
</html>