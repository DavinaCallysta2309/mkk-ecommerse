<?php
include('login.php'); // Pastikan koneksi database dilakukan di sini

// Ambil ID dari query string
if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query untuk mengambil data
$sql = "SELECT * FROM admin_dasboard WHERE id='$id'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

// Periksa apakah data ditemukan
if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}

$product = mysqli_fetch_assoc($query);

// Variabel data produk
$nama_barang = $product['nama_barang'];
$harga_barang = $product['harga_barang'];
$stock_barang = $product['stock_barang'];
$deskripsi_barang = $product['deskripsi_barang'];
$foto = $product['foto'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Produk</h2>
        <form method="post" action="proses-edit.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" value="<?= htmlspecialchars($nama_barang) ?>" class="form-control" id="nama_barang" placeholder="Nama Barang" required>
            </div>

            <div class="mb-3">
                <label for="harga_barang" class="form-label">Harga Barang</label>
                <input type="text" name="harga_barang" value="<?= htmlspecialchars($harga_barang) ?>" class="form-control" id="harga_barang" placeholder="Harga Barang" required>
            </div>

            <div class="mb-3">
                <label for="stock_barang" class="form-label">Stock Barang</label>
                <input type="text" name="stock_barang" value="<?= htmlspecialchars($stock_barang) ?>" class="form-control" id="stock_barang" placeholder="Stock Barang" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
                <input type="text" name="deskripsi_barang" value="<?= htmlspecialchars($deskripsi_barang) ?>" class="form-control" id="deskripsi_barang" placeholder="Deskripsi Barang" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" id="foto">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
