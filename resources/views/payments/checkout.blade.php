<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="text-center mb-4">Form Pembayaran</h2>
    <form id="paymentForm">
        <div class="mb-3">
            <label class="form-label">Produk</label>
            <input type="text" class="form-control" value="{{ $name }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="text" class="form-control" value="Rp {{ number_format($price, 0, ',', '.') }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" class="form-control" id="buyerName" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor WhatsApp</label>
            <input type="tel" class="form-control" id="phoneNumber" placeholder="Contoh: 628123456789" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat Pengiriman</label>
            <input type="text" class="form-control" id="address" required>
        </div>
        <button type="button" class="btn btn-success w-100" onclick="sendToWhatsApp()">Kirim ke WhatsApp</button>
    </form>

    <script>
        function sendToWhatsApp() {
            var name = "{{ $name }}";
            var price = "Rp {{ number_format($price, 0, ',', '.') }}";
            var buyer = document.getElementById("buyerName").value;
            var phone = document.getElementById("phoneNumber").value;
            var address = document.getElementById("address").value;

            if (buyer === "" || phone === "" || address === "") {
                alert("Harap isi semua data!");
                return;
            }

            var message = `Halo, saya ingin membeli:\n` +
                          `Produk: ${name}\n` +
                          `Harga: ${price}\n` +
                          `Nama: ${buyer}\n` +
                          `Nomor WhatsApp: ${phone}\n` +
                          `Alamat Pengiriman: ${address}`;

            var whatsappURL = `https://wa.me/6285724887713?text=${encodeURIComponent(message)}`;
            window.open(whatsappURL, "_blank");
        }
    </script>

</body>
</html>
