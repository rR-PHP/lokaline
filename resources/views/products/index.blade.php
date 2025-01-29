<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard UMKM</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <!-- Tombol Login -->
            <img src="{{ asset('image/lokalinelogo.png') }}" alt="Logo Lokaline" height="65px">
        </div>
        <div class="navbar-brand">LOKALINE</div>
        <a href="{{ route('login') }}" class="login-button">Login</a>
    </header>

    <main>
        <section class="hero">
            <div class="hero-text">Selamat Datang di LOKALINE!</div>
        </section>

        <section class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-details">
                        <h3>{{ $product->name }}</h3>
                        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="seller"><img src="{{ asset('image/location.png') }}" class="icon"> {{ $product->location }}</p>
                        <button class="buy-button" onclick="location.href='{{ url('/payment?name=' . urlencode($product->name) . '&price=' . $product->price . '&location=' . urlencode($product->location)) }}'">
                            Beli Sekarang
                        </button>
                    </div>
                </div>
            @endforeach
        </section>
    </main>

    <footer class="site-footer">
        <div class="footer-content">
            <h3>Tentang Kami</h3>
            <p>LOKALINE adalah platform e-commerce yang mendukung UMKM.</p>
            <p>&copy; 2025 LOKALINE. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
