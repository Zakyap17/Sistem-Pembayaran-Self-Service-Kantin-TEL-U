@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pesanan</h2>

    <form method="POST" action="{{ route('orders.update', $order->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Total Harga</label>
            <input type="number" name="total_amount" class="form-control" value="{{ $order->total_amount }}">
        </div>

        <button type="submit" class="btn btn-success mt-2">Update Pesanan</button>
    </form>
</div>
@endsection
