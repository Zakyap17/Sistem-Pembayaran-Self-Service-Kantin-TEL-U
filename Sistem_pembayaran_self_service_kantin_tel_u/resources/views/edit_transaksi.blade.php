<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f4f7fc;
        }

        .header {
            background-color: #444744;
            padding: 15px;
            color: white;
            text-align: center;
            font-size: 24px;
        }

        .container {
            padding: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #444744;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #333;
        }

        .footer {
            background-color: #444744;
            padding: 10px;
            color: white;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }

            .form-container input,
            .form-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Edit Transaksi</h1>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="form-container">
            <h2>Form Edit Transaksi</h2>

            <!-- Form untuk mengedit transaksi -->
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Digunakan untuk memproses form sebagai metode PUT -->

                <!-- Input untuk Nama Pelanggan -->
                <label for="pelanggan">Nama Pelanggan:</label>
                <input type="text" name="pelanggan" id="pelanggan" value="{{ $transaksi->pelanggan }}" required>

                <!-- Input untuk Total -->
                <label for="total">Total:</label>
                <input type="number" name="total" id="total" value="{{ $transaksi->total }}" required>

                <!-- Input untuk Status -->
                <label for="status">Status:</label>
                <input type="text" name="status" id="status" value="{{ $transaksi->status }}" required>

                <!-- Tombol untuk menyimpan perubahan -->
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Sistem Pembayaran Kantin Tel U</p>
    </div>

</body>
</html>
