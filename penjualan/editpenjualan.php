<?php
session_start();
include("../db.php");
 
// Create a new instance of the db class
$database = new db();

// Fetch the penjualan details based on the provided ID
$penjualan = $database->getPenjualan($_GET['id_penjualan'] ?? '');

// Fetch all shifts for the dropdown
$shifts = $database->getAllShifts();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the penjualan details
    $database->updatePenjualan(
        $_POST['id_penjualan'],
        $_POST['waktu_transaksi'],
        $_POST['total'],
        $_POST['id_shift']
    );
    $_SESSION['message'] = "Data berhasil diubah!";
    header("Location: tampilpenjualan.php");
    exit;
}
?>

<?php
include "../templates/header.php";
include "../templates/sidebar.php";
include "../templates/topbar.php";
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Data Penjualan</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_penjualan">ID Penjualan</label>
            <input type="text" class="form-control" id="id_penjualan" name="id_penjualan" value="<?= htmlspecialchars($penjualan['ID_Penjualan']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="waktu_transaksi">Waktu Transaksi</label>
            <input type="datetime-local" class="form-control" id="waktu_transaksi" name="waktu_transaksi" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($penjualan['WaktuTransaksi']))); ?>" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" class="form-control" id="total" name="total" value="<?= htmlspecialchars($penjualan['Total']); ?>" required>
        </div>
        <div class="form-group">
            <label for="id_shift">ID Shift</label>
            <select class="form-control" id="id_shift" name="id_shift" required>
                <?php
                while ($row = $shifts->fetch_assoc()) {
                    $selected = ($row['ID_Shift'] == $penjualan['ID_Shift']) ? 'selected' : '';
                    echo "<option value='" . $row['ID_Shift'] . "' $selected>" . $row['ID_Shift'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="tampilpenjualan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</div>

<?php
include "../templates/footer.php";
?>
