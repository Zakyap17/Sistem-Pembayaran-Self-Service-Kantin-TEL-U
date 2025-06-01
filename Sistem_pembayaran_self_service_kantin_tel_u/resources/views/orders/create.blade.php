<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan Baru</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <h2>Buat Pesanan Baru</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('orders.store') }}">
            @csrf

            <div id="menu-list">
                <h5>Pilih Menu:</h5>

                @foreach ($menus as $menu)
                    <div class="form-group mb-2">
                        <label>{{ $menu->name }} (Rp {{ number_format($menu->price, 0, ',', '.') }})</label>
                        <input type="number" name="menu[{{ $menu->id }}]" class="form-control" placeholder="Jumlah" min="0" value="0">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Buat Pesanan</button>
        </form>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
