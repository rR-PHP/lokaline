
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    
                    <!-- Tombol Logout -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm ms-3">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Dashboard -->
        <section id="dashboard">
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Produk</div>
                        <div class="card-body"><h5 class="card-title">{{ $totalProduk }}</h5></div>
                    </div>
                </div>
        </section>

        <!-- Manajemen Produk -->
        <section id="produk" class="mt-4">
            <h2>Manajemen Produk</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Tambah Produk</button>
            <table class="table table-bordered">
                <thead>
                    <tr><th>No</th><th>Nama Produk</th><th>Gambar Produk</th><th>Harga</th><th>Aksi</th></tr>
                </thead>
                <tbody id="productTableBody">
                    @foreach($products as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                        <img style="max-width: 200px;"  src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                        </td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $item->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <!-- Modal untuk Menambah/Edit Produk -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="addProductForm">
                            @csrf
                            <div class="mb-3">
                                <label for="productName" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label>Upload Gambar:</label>
                                <input type="file" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Tangkap elemen modal dan form
        const productModal = new bootstrap.Modal(document.getElementById("addProductModal"));
        const productForm = document.getElementById("addProductForm");
        const modalTitle = document.getElementById("addProductModalLabel");
        
        let isEditing = false;
        let editProductId = null;

        // Reset modal saat ditutup
        document.getElementById("addProductModal").addEventListener("hidden.bs.modal", function () {
            productForm.reset();
            productForm.action = "{{ route('products.store') }}";
            modalTitle.textContent = "Tambah Produk";
            isEditing = false;
        });

        // Tangani klik tombol edit
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                console.log("Tombol Edit Diklik!");
                const productId = this.dataset.id;
                console.log("Mengedit produk dengan ID :", productId);
                editProductId = productId;
                isEditing = true;
                
                fetch(`/admin/products/${productId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        productForm.name.value = data.name;
                        productForm.price.value = data.price;
                        productForm.action = `/products/${productId}`;
                        modalTitle.textContent = "Edit Produk";
                        productModal.show();
                    });
            });
        });
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                const productId = this.dataset.id;

                if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
                    fetch(`/admin/products/${productId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success);
                        location.reload(); // Refresh halaman setelah delete
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
        });
    });
</script>
    
</body>
