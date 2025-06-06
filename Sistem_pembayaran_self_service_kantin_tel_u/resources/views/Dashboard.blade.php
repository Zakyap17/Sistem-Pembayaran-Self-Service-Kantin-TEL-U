<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f4f7fc;
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

        .card-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
            text-align: center;
            box-sizing: border-box;
            transition: transform 0.3s;
        }

        .card h3 {
            margin-bottom: 15px;
            font-size: 20px;
        }

        .card a {
            display: inline-block;
            background-color: #444744;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .card a:hover {
            background-color: #;
            transform: translateY(-3px);
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
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center;
            }
            .card {
                width: 90%;
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
        <div class="card-container">
            <div class="card">
                <h3>Pesan Makanan</h3>
                <p>Pesan makanan favorit Anda dengan mudah.</p>
                <a href="{{ route('order.index') }}">Pesan Sekarang</a>
            </div>

            <div class="card">
                <h3>Riwayat Transaksi</h3>
                <p>Lihat riwayat transaksi Anda yang telah dilakukan.</p>
                <a href="{{ route('transaksi.index') }}">Lihat Riwayat</a>
            </div>

            <div class="card">
                <h3>Kelola Transaksi</h3>
                <p>Kelola dan atur transaksi yang ada.</p>
                <a href="{{ route('kelola.transaksi') }}">Kelola Transaksi</a>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Sistem Pembayaran Kantin Tel U</p>
    </div>
</body>
</html>
