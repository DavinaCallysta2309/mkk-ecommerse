<?php
include('login.php'); // Pastikan koneksi database dilakukan di sini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga_barang = mysqli_real_escape_string($koneksi, $_POST['harga_barang']);
    $stock_barang = mysqli_real_escape_string($koneksi, $_POST['stock_barang']);
    $deskripsi_barang = mysqli_real_escape_string($koneksi, $_POST['deskripsi_barang']);

    // Mengelola file upload
    $foto = $_FILES['foto']['name'];
    if ($foto) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
        $foto = mysqli_real_escape_string($koneksi, $foto);
    } else {
        // Jika tidak ada file yang di-upload, ambil foto yang sudah ada
        $sql = "SELECT foto FROM admin_dasboard WHERE id='$id'";
        $query = mysqli_query($koneksi, $sql);
        $result = mysqli_fetch_assoc($query);
        $foto = $result['foto'];
    }

    // Query untuk update data
    $sql = "UPDATE admin_dasboard SET 
        nama_barang='$nama_barang',
        harga_barang='$harga_barang',
        stock_barang='$stock_barang',
        deskripsi_barang='$deskripsi_barang',
        foto='$foto'
        WHERE id='$id'";

    if (mysqli_query($koneksi, $sql)) {
        header('Location: dashboard.php');
        exit;
    } else {
        die("Error updating record: " . mysqli_error($koneksi));
    }
}
?>