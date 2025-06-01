{{-- Anda mungkin punya layout admin sendiri, sesuaikan --}}
{{-- @extends('layouts.admin_app') --}}
{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Menu Favorit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7fc; }
        .header { background-color: #81a7aa; padding: 15px; color: white; text-align: center; font-size: 24px; margin-bottom: 20px; }
        .container-custom { padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .table img { max-width: 100px; height: auto; border-radius: 4px; }
        .table th, .table td { vertical-align: middle; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Kelola Menu Favorit</h1>
    </div>

    <div class="container container-custom">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('admin.favorite-menus.create') }}" class="btn btn-primary">Tambah Menu Favorit Baru</a>
        </div>

        @if($favoriteMenus->isEmpty())
            <div class="alert alert-info">Belum ada menu favorit yang ditambahkan.</div>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Gambar</th>
                        <th>Nama Menu</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Pembelian (Contoh)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($favoriteMenus as $favMenu)
                        <tr>
                            <td>{{ $favMenu->rank }}</td>
                            <td>
                                @if($favMenu->image)
                                    <img src="{{ $favMenu->image }}" alt="{{ $favMenu->menu->name ?? 'Gambar Menu' }}">
                                @else
                                    Tanpa Gambar
                                @endif
                            </td>
                            <td>{{ $favMenu->menu->name ?? 'Menu tidak ditemukan' }}</td>
                            <td>{{ Str::limit($favMenu->description, 50) }}</td>
                            <td>
                                {{-- Data ini perlu diambil dari relasi atau join dengan tabel statistik --}}
                                {{ $favMenu->menu->purchase_count ?? 'N/A' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.favorite-menus.edit', $favMenu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.favorite-menus.destroy', $favMenu->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini dari daftar favorit?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
{{-- @endsection --}}