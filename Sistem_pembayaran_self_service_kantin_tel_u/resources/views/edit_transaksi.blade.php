<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Edit Transaksi</h2>

        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="pelanggan">Nama Pelanggan:</label>
            <input type="text" name="pelanggan" id="pelanggan" value="{{ $transaksi->pelanggan }}" required>
            
            <label for="total">Total:</label>
            <input type="number" name="total" id="total" value="{{ $transaksi->total }}" required>

            <label for="status">Status:</label>
            <input type="text" name="status" id="status" value="{{ $transaksi->status }}" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
