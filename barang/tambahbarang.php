<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang  = $_POST['nama_barang'];
    $satuan       = $_POST['satuan'];
    $harga_satuan = $_POST['harga_satuan'];

    $database = new db();
    if ($database->createBarang($nama_barang, $satuan, $harga_satuan)) {
        $_SESSION['message'] = "Data barang berhasil disimpan!";
    } else {
        $_SESSION['message'] = "Gagal menyimpan data: " . $database->koneksi->error;
    }

    header("Location: tampilbarang.php");
    exit; 
}
?>

<?php
include "../templates/header.php";
include "../templates/sidebar.php";
include "../templates/topbar.php";
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Barang</h1>
    <form method="post" action="">

        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang" required>
        </div>

        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukkan Satuan Barang" required>
        </div>

        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" placeholder="Masukkan Harga Satuan Barang" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="tampilbarang.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
include "../templates/footer.php";
?>
