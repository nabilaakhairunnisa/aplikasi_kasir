<?php
session_start();
include("../db.php");

$database = new db();
$barang = $database->getBarangById($_GET['id_barang'] ?? '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database->updateBarang(
        $_POST['id_barang'],
        $_POST['nama_barang'],
        $_POST['satuan'],
        $_POST['harga_satuan']
    );
    $_SESSION['message'] = "Data berhasil diubah!";
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
    <h1 class="h3 mb-4 text-gray-800">Edit Data Barang</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_barang">ID Barang</label>
            <input type="text" class="form-control" id="id_barang" name="id_barang" value="<?= $barang['ID_Barang']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['NamaBarang']; ?>">
        </div>
        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $barang['Satuan']; ?>">
        </div>
        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= $barang['HargaSatuan']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="tampilbarang.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</div>

<?php
include "../templates/footer.php";
?>
