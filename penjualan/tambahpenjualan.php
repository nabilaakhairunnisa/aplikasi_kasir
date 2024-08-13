<?php
session_start();
include("../db.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktuTransaksi  = $_POST['waktu_transaksi'];
    $total           = $_POST['total'];
    $id_shift        = $_POST['id_shift'];

    $database = new db();
    if ($database->createPenjualan($waktuTransaksi, $total, $id_shift)) {
        $_SESSION['message'] = "Data berhasil disimpan!";
    } else {
        $_SESSION['message'] = "Gagal menyimpan data: " . $database->koneksi->error;
    }

    header("Location: tampilpenjualan.php");
    exit;
}
?>

<?php
include "../templates/header.php";
include "../templates/sidebar.php";
include "../templates/topbar.php";

// Get ID_Shift options from the database
$database = new db();
$shifts = $database->getAllShifts();
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Penjualan</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="waktu_transaksi">Waktu Transaksi</label>
            <input type="datetime-local" class="form-control" id="waktu_transaksi" name="waktu_transaksi" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" class="form-control" id="total" name="total" placeholder="Masukkan total" required>
        </div>
        <div class="form-group">
            <label for="id_shift">ID Shift</label>
            <select class="form-control" id="id_shift" name="id_shift" required>
                <option value="">Pilih Shift</option>
                <?php
                while ($row = $shifts->fetch_assoc()) {
                    echo "<option value='" . $row['ID_Shift'] . "'>" . $row['ID_Shift'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="tampilpenjualan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</div>

<?php
include "../templates/footer.php";
?>