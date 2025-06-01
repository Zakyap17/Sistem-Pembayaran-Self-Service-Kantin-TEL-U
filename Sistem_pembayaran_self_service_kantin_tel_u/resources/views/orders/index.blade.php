@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riwayat Pesanan</h2>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">+ Buat Pesanan Baru</a>
        
        <table class="table">
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
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin batalin pesanan?')">Batalkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection