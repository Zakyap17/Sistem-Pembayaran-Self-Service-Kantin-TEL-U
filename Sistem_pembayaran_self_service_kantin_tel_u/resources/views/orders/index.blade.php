@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riwayat Pesanan</h2>
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">+ Buat Pesanan Baru</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
