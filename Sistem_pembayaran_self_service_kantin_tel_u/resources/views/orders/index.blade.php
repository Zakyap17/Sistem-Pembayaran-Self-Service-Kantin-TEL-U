<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Riwayat Pesanan</h2>

       
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

       
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">+ Buat Pesanan Baru</a>
        
       
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Dibuat</th>
                    <th>Detail Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <ul>
                            @foreach ($order->details as $detail)
                                <li>{{ $detail->menu->name }} - {{ $detail->quantity }} porsi (Rp {{ number_format($detail->subtotal, 0, ',', '.') }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if ($order->status === 'pending')
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin batalin pesanan?')">Batalkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   
    <div class="footer text-center mt-5">
        <p>&copy; 2025 Sistem Pembayaran Kantin Tel U</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
