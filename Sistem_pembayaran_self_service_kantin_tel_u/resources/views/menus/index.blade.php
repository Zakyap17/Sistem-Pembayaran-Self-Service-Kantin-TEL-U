<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Kantin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #000; 
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #000; 
            text-align: center;
            margin-top: 50px;
        }

        .container {
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .btn {
            border-radius: 25px;
            font-size: 1rem;
            padding: 10px 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        table {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            color: #000; /
        }

        th {
            background-color: #007bff;
            color: #fff; 
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .actions-btn {
            display: flex;
            gap: 10px;
        }

        .actions-btn a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            .container {
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .btn {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Menu Kantin</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-primary mb-4">Tambah Menu</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->description }}</td>
                        <td>{{ number_format($menu->price, 2, ',', '.') }}</td>
                        <td class="actions-btn">
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
