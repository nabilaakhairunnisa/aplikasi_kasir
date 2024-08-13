<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $namaKasir = $_POST['namaKasir'];
    $alamat = $_POST['alamat'];
    $nomorHP = $_POST['nomorHP'];
    $nomorKTP = $_POST['nomorKTP'];
    $password = md5($_POST['password']); // Hash password dengan MD5

    $database = new db();
    $database->createKasir($username, $namaKasir, $alamat, $nomorHP, $nomorKTP, $password);
    $_SESSION['message'] = "Data kasir berhasil disimpan!";

    header("Location: tampilkasir.php");
    exit;
}
?>

<?php
include "../templates/header.php";
include "../templates/sidebar.php";
include "../templates/topbar.php";
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Kasir</h1>

    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="namaKasir">Nama Kasir</label>
            <input type="text" class="form-control" id="namaKasir" name="namaKasir" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="nomorHP">Nomor HP</label>
            <input type="text" class="form-control" id="nomorHP" name="nomorHP" required>
        </div>
        <div class="form-group">
            <label for="nomorKTP">Nomor KTP</label>
            <input type="text" class="form-control" id="nomorKTP" name="nomorKTP" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="tampilkasir.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
include "../templates/footer.php";
?>
