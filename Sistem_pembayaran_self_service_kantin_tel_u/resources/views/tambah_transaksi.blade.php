<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <label for="pelanggan">Nama Pelanggan:</label>
    <input type="text" name="pelanggan" id="pelanggan" required>

    <label for="total">Total:</label>
    <input type="number" name="total" id="total" required>

    <label for="status">Status:</label>
    <input type="text" name="status" id="status" required>

    <button type="submit">Simpan</button>
</form>
