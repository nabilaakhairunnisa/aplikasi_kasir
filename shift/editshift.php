<?php
session_start();
include("../db.php");

// Create a new instance of the db class
$database = new db();

// Fetch the shift details based on the provided ID
$shift = $database->getShift($_GET['id_shift'] ?? '');

// Get all Kasir for the dropdown
$kasirList = $database->getAllKasir();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the shift details
    if ($database->updateShift(
        $_POST['id_shift'],
        $_POST['id_kasir'],
        $_POST['waktu_buka'],
        $_POST['saldo_awal'],
        $_POST['jumlah_penjualan'],
        $_POST['saldo_akhir'],
        $_POST['waktu_tutup'],
        $_POST['status']
    )) {
        $_SESSION['message'] = "Data berhasil diubah!";
    } else {
        $_SESSION['message'] = "Gagal mengubah data: " . $database->koneksi->error;
    }
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
    <h1 class="h3 mb-4 text-gray-800">Edit Data Shift</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_shift">ID Shift</label>
            <input type="text" class="form-control" id="id_shift" name="id_shift" value="<?= htmlspecialchars($shift['ID_Shift']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="id_kasir">ID Kasir</label>
            <select class="form-control" id="id_kasir" name="id_kasir" required>
                <?php while ($row = $kasirList->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['ID_Kasir']); ?>" <?= $shift['ID_Kasir'] == $row['ID_Kasir'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($row['ID_Kasir']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="waktu_buka">Waktu Buka</label>
            <input type="datetime-local" class="form-control" id="waktu_buka" name="waktu_buka" value="<?= date('Y-m-d\TH:i', strtotime($shift['WaktuBuka'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="saldo_awal">Saldo Awal</label>
            <input type="number" step="0.01" class="form-control" id="saldo_awal" name="saldo_awal" value="<?= htmlspecialchars($shift['SaldoAwal']); ?>" required>
        </div>
        <div class="form-group">
            <label for="jumlah_penjualan">Jumlah Penjualan</label>
            <input type="number" step="0.01" class="form-control" id="jumlah_penjualan" name="jumlah_penjualan" value="<?= htmlspecialchars($shift['JumlahPenjualan']); ?>" required>
        </div>
        <div class="form-group">
            <label for="saldo_akhir">Saldo Akhir</label>
            <input type="number" step="0.01" class="form-control" id="saldo_akhir" name="saldo_akhir" value="<?= htmlspecialchars($shift['SaldoAkhir']); ?>" required>
        </div>
        <div class="form-group">
            <label for="waktu_tutup">Waktu Tutup</label>
            <input type="datetime-local" class="form-control" id="waktu_tutup" name="waktu_tutup" value="<?= date('Y-m-d\TH:i', strtotime($shift['WaktuTutup'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="<?= htmlspecialchars($shift['Status']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="tampilshift.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</div>

<?php
include "../templates/footer.php";
?>
