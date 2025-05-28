@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Buat Pesanan Baru</h2>
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <button type="submit" class="btn btn-success">Konfirmasi Pesanan</button>
        </form>
    </div>
@endsection
