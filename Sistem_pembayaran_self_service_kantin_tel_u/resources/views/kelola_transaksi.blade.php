<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi</title>
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

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .transaction-table th, .transaction-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .transaction-table th {
            background-color: #444744;
            color: white;
        }

        .transaction-table tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            padding: 8px 15px;
            background-color: #444744;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .action-buttons a:hover {
            background-color: #444744;
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
            .transaction-table th, .transaction-table td {
                font-size: 12px;
            }

            .action-buttons a {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Kelola Transaksi</h1>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2>Daftar Transaksi</h2>

        <!-- Daftar Transaksi -->
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Sistem Pembayaran Kantin Tel U</p>
    </div>

</body>
</html>
