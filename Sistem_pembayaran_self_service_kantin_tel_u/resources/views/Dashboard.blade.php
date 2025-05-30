<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f4f7fc;
            padding-bottom: 60px; /* Tambahkan padding bawah untuk footer */
        }

        .header {
            background-color: #81a7aa;
            padding: 15px;
            color: white;
            text-align: center;
            font-size: 24px;
        }

        .container {
            padding: 20px;
        }

        .section-title { /* Gaya untuk judul bagian seperti Menu Favorit */
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap; /* Biarkan card wrap ke baris berikutnya jika tidak muat */
            justify-content: center; /* Pusatkan card jika tidak mengisi semua space */
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(33.333% - 20px); /* Lebar card, dengan gap */
            min-width: 280px; /* Lebar minimum card */
            text-align: center;
            box-sizing: border-box;
            transition: transform 0.3s;
            display: flex; /* Untuk tata letak konten card */
            flex-direction: column; /* Susun konten secara vertikal */
            justify-content: space-between; /* Beri ruang antar konten */
        }
         .card:hover {
            transform: translateY(-5px); /* Efek hover yang lebih terlihat */
        }

        .card img.favorite-image { /* Styling untuk gambar menu favorit */
            max-width: 100%;
            height: 150px; /* Tinggi tetap untuk gambar */
            object-fit: cover; /* Pastikan gambar terisi tanpa distorsi */
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin-top: 0; /* Hapus margin atas default */
            margin-bottom: 10px;
            font-size: 18px; /* Ukuran font lebih kecil untuk card favorit */
            color: #333;
        }

        .card .rank {
            font-size: 12px;
            background-color: #81a7aa;
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .card .purchase-count { /* Gaya untuk jumlah pembelian */
            font-size: 13px;
            color: #777;
            margin-bottom: 15px;
        }

        .card a.action-button { /* Ganti nama kelas agar lebih spesifik */
            display: inline-block;
            background-color: #444744;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: auto; /* Dorong tombol ke bawah card */
            transition: background-color 0.3s, transform 0.3s;
        }

        .card a.action-button:hover {
            background-color: #5a5e5a; /* Warna hover yang sedikit berbeda */
            transform: translateY(-2px); /* Efek hover lebih halus */
        }

        .card p {
            font-size: 14px;
            color: #555;
            flex-grow: 1; /* Biarkan deskripsi mengambil ruang yang tersedia */
            margin-bottom: 15px;
        }

        /* Footer */
        .footer {
            background-color: #81a7aa;
            padding: 10px;
            color: white;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Responsive design */
        @media (max-width: 992px) { /* Tablet */
            .card {
                width: calc(50% - 20px); /* 2 card per baris */
            }
        }
        @media (max-width: 768px) { /* Mobile besar */
            .card-container {
                flex-direction: column;
                align-items: center;
            }
            .card {
                width: 90%; /* 1 card per baris */
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Dashboard</h1>
    </div>

    <div class="container">
        <h2>Selamat datang di Kantin Tel-U</h2>

        {{-- Bagian Menu Favorit untuk Mahasiswa --}}
        @if(isset($favoriteMenus) && $favoriteMenus->isNotEmpty())
            <h3 class="section-title">🌟 Menu Favorit Kami 🌟</h3>
            <div class="card-container favorite-menu-container">
                @foreach ($favoriteMenus as $favMenu)
                    <div class="card favorite-item-card">
                        @if($favMenu->image)
                            <img src="{{ $favMenu->image }}" alt="{{ $favMenu->menu->name ?? 'Gambar Menu' }}" class="favorite-image">
                        @else
                            <img src="https://via.placeholder.com/300x150?text=Menu+Favorit" alt="Placeholder" class="favorite-image"> {{-- Placeholder jika tidak ada gambar --}}
                        @endif
                        <h3>{{ $favMenu->menu->name ?? 'Nama Menu' }}</h3>
                        <span class="rank">Peringkat #{{ $favMenu->rank }}</span>
                        @if($favMenu->description)
                            <p>{{ Str::limit($favMenu->description, 70) }}</p>
                        @endif
                        {{-- Anda mungkin ingin menampilkan jumlah pembelian jika data tersedia --}}
                        {{-- <p class="purchase-count">Dibeli: {{ $favMenu->menu->purchases_count ?? 0 }} kali</p> --}}

                        {{-- Tombol bisa mengarah ke halaman detail menu atau langsung pesan --}}
                        <a href="#" class="action-button">Lihat Detail</a>
                    </div>
                @endforeach
            </div>
        @else
             {{-- Tampilkan ini jika mahasiswa login tapi belum ada menu favorit --}}
             @auth {{-- Cek apakah pengguna login (asumsi mahasiswa) --}}
                @if(!Auth::user()->isAdmin()) {{-- Contoh jika ada role admin --}}
                    <div class="text-center mt-4">
                        <h3 class="section-title">Menu Favorit</h3>
                        <p>Belum ada menu favorit yang ditetapkan saat ini. Cek kembali nanti!</p>
                        {{-- Bisa tambahkan ilustrasi di sini --}}
                    </div>
                @endif
             @endauth
        @endif
        {{-- Akhir Bagian Menu Favorit --}}


        {{-- Bagian Card Lainnya (Pesan Makanan, Riwayat, dll.) --}}
        {{-- Anda bisa membungkus card-card ini dengan kondisi berdasarkan role jika perlu --}}
        {{-- Misal, 'Kelola Transaksi' hanya untuk Admin --}}

        <h3 class="section-title">Layanan Lainnya</h3>
        <div class="card-container">
            <div class="card">
                <h3>Pesan Makanan</h3>
                <p>Pesan makanan favorit Anda dengan mudah dari berbagai tenant.</p>
                <a href="#" class="action-button">Pesan Sekarang</a>
            </div>

            <div class="card">
                <h3>Riwayat Transaksi</h3>
                <p>Lihat riwayat transaksi Anda yang telah dilakukan.</p>
                <a href="#" class="action-button">Lihat Riwayat</a>
            </div>

            {{-- @if(Auth::check() && Auth::user()->isAdmin()) --}}
            <div class="card">
                <h3>Kelola Transaksi</h3>
                <p>Kelola dan atur transaksi yang ada.</p>
                <a href="{{ route('admin.favorite-menus.index') /* Contoh route, sesuaikan */ }}" class="action-button">Kelola Transaksi</a>
            </div>
            {{-- @endif --}}

             {{-- Tambahan: Kelola Menu Favorit (Hanya untuk Admin) --}}
             {{-- @if(Auth::check() && Auth::user()->isAdmin()) --}}
             <div class="card">
                <h3>Kelola Menu Favorit</h3>
                <p>Atur daftar menu yang menjadi favorit pelanggan.</p>
                <a href="{{ route('admin.favorite-menus.index') }}" class="action-button">Kelola Favorit</a>
            </div>
            {{-- @endif --}}
        </div>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Sistem Pembayaran Kantin Tel U</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>