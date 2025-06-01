<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Pesanan</h2>

        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    
        <form method="POST" action="{{ route('orders.update', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Status Pesanan:</label>
                <select class="form-control" name="status" id="status">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning mt-3">Update Pesanan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap.bundle.min.js"></script>
</body>
</html>
