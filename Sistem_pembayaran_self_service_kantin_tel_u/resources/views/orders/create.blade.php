@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Buat Pesanan Baru</h2>

        <form method="POST" action="{{ route('orders.store') }}">
            @csrf

            <div id="menu-list">
                <h5>Pilih Menu:</h5>

                @foreach ($menus as $menu)
                    <div class="form-group mb-2">
                        <label>{{ $menu->name }} (Rp {{ number_format($menu->price, 0, ',', '.') }})</label>
                        <input type="number" name="menu[{{ $menu->id }}]" class="form-control" placeholder="Jumlah" min="0" value="0">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Buat Pesanan</button>
        </form>
    </div>
@endsection
