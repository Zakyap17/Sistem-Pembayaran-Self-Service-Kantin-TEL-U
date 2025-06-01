<!-- resources/views/orders/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f8fb;
        }
        .container {
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .card-header {
            font-size: 24px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            color: #aaa;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Buat Pesanan Baru
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="menu">Pilih Menu:</label>
                        @foreach ($menus as $menu)
                            <div class="form-group mb-2">
                            <label>{{ $menu->name }} (Rp {{ number_format($menu->price, 0, ',', '.') }})</label>
                            <input type="number" name="menu[{{ $menu->id }}]" class="form-control" min="0" value="0">
                    </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Buat Pesanan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Sistem Pembayaran Kantin Tel U</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
