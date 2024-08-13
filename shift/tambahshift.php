<?php
session_start();
include("../db.php");

$database = new db();

// Ambil semua ID Kasir dari database
$kasirOptions = $database->getAllKasir();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $id_kasir        = $_POST['id_kasir'];
    $waktuBuka       = $_POST['waktu_buka'];
    $saldoAwal       = $_POST['saldo_awal'];
    $jumlahPenjualan = $_POST['jumlah_penjualan'];
    $saldoAkhir      = $_POST['saldo_akhir'];
    $waktuTutup      = $_POST['waktu_tutup'];
    $status          = $_POST['status'];

    // Insert the new shift record into the database
    if ($database->createShift($id_kasir, $waktuBuka, $saldoAwal, $jumlahPenjualan, $saldoAkhir, $waktuTutup, $status)) {
        $_SESSION['message'] = "Data berhasil disimpan!";
    } else {
        $_SESSION['message'] = "Gagal menyimpan data: " . $database->koneksi->error;
    }

    // Redirect to the shift.php page
    header("Location: tampilshift.php");
    exit;
}
?>

<?php
include "../templates/header.php";
include "../templates/sidebar.php";
include "../templates/topbar.php";
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Shift</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_kasir">ID Kasir</label>
            <select class="form-control" id="id_kasir" name="id_kasir" required>
                <option value="">Pilih Kasir</option>
                <?php
                while ($kasir = $kasirOptions->fetch_assoc()) {
                    echo "<option value='" . $kasir['ID_Kasir'] . "'>" . $kasir['ID_Kasir'] . " - " . $kasir['NamaKasir'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="waktu_buka">Waktu Buka</label>
            <input type="datetime-local" class="form-control" id="waktu_buka" name="waktu_buka" value="<?= date('Y-m-d\TH:i'); ?>" required>
        </div>
        <div class="form-group">
            <label for="saldo_awal">Saldo Awal</label>
            <input type="number" step="0.01" class="form-control" id="saldo_awal" name="saldo_awal" placeholder="Masukkan Saldo Awal" required>
        </div>
        <div class="form-group">
            <label for="jumlah_penjualan">Jumlah Penjualan</label>
            <input type="number" step="0.01" class="form-control" id="jumlah_penjualan" name="jumlah_penjualan" placeholder="Masukkan Jumlah Penjualan" required>
        </div>
        <div class="form-group">
            <label for="saldo_akhir">Saldo Akhir</label>
            <input type="number" step="0.01" class="form-control" id="saldo_akhir" name="saldo_akhir" placeholder="Masukkan Saldo Akhir" required>
        </div>
        <div class="form-group">
            <label for="waktu_tutup">Waktu Tutup</label>
            <input type="datetime-local" class="form-control" id="waktu_tutup" name="waktu_tutup" value="<?= date('Y-m-d\TH:i'); ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" placeholder="Masukkan Status" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="shift.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
include "../templates/footer.php";
?>