<?php
session_start();
include("../db.php");

$database = new db();
$kasir = $database->getIdKasir($_GET['id_kasir'] ?? '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database->editKasir(
        $_POST['id_kasir'],
        $_POST['username'],
        $_POST['nama_kasir'],
        $_POST['alamat'],
        $_POST['nomor_hp'],
        $_POST['nomor_ktp']
    );
    $_SESSION['message'] = "Data kasir berhasil diubah!";
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
    <h1 class="h3 mb-4 text-gray-800">Edit Data Kasir</h1>
    <form method="post" action="">
        <input type="hidden" name="id_kasir" value="<?= $kasir['ID_Kasir']; ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $kasir['Username']; ?>" required>
        </div>
        <div class="form-group">
            <label for="nama_kasir">Nama Kasir</label>
            <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" value="<?= $kasir['NamaKasir']; ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $kasir['Alamat']; ?>" required>
        </div>
        <div class="form-group">
            <label for="nomor_hp">Nomor HP</label>
            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?= $kasir['NomorHP']; ?>" required>
        </div>
        <div class="form-group">
            <label for="nomor_ktp">Nomor KTP</label>
            <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" value="<?= $kasir['NomorKTP']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="tampilkasir.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
include "../templates/footer.php";
?>
