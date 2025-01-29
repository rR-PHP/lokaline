<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama Produk:</label>
    <input type="text" name="name" required><br>

    <label>Deskripsi:</label>
    <textarea name="description"></textarea><br>

    <label>Harga:</label>
    <input type="number" name="price" required><br>

    <label>Lokasi:</label>
    <input type="text" name="location"><br>

    <label>Upload Gambar:</label>
    <input type="file" name="image"><br>

    <button type="submit">Tambah Produk</button>
</form>
