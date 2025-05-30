{{-- @extends('layouts.admin_app') --}}
{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu Favorit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7fc; }
        .header { background-color: #81a7aa; padding: 15px; color: white; text-align: center; font-size: 24px; margin-bottom: 20px; }
        .container-custom { padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 700px; margin: auto; }
        .current-image { max-width: 150px; margin-top: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Edit Menu Favorit: {{ $favoriteMenu->menu->name ?? 'N/A' }}</h1>
    </div>

    <div class="container container-custom">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.favorite-menus.update', $favoriteMenu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Menu Makanan</label>
                <input type="text" class="form-control" value="{{ $favoriteMenu->menu->name ?? 'Menu tidak ditemukan' }}" readonly>
                {{-- Jika Anda ingin memperbolehkan mengubah menu, ganti dengan dropdown seperti di create form --}}
                {{-- Namun, biasanya item favorit tidak diubah menunya, melainkan dihapus dan dibuat baru jika salah --}}
            </div>

            <div class="mb-3">
                <label for="rank" class="form-label">Urutan Favorit (Peringkat) <span class="text-danger">*</span></label>
                <input type="number" name="rank" id="rank" class="form-control @error('rank') is-invalid @enderror" value="{{ old('rank', $favoriteMenu->rank) }}" required min="1">
                @error('rank')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                 <small class="form-text text-muted">Jika peringkat sudah digunakan, sistem akan otomatis menukar posisi.</small>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Singkat</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $favoriteMenu->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ganti Logo/Gambar Representatif</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($favoriteMenu->image)
                    <div class="mt-2">
                        <small>Gambar Saat Ini:</small><br>
                        <img src="{{ $favoriteMenu->image }}" alt="Gambar Menu Favorit" class="current-image">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.favorite-menus.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Perbarui Menu Favorit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
{{-- @endsection --}}