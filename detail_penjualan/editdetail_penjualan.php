<?php
session_start();
include("../db.php");

$database = new db();
$detail_penjualan = $database->getDetailPenjualan($_GET['id_penjualan'] ?? '', $_GET['id_barang'] ?? '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database->updateDetailPenjualan(
        $_POST['id_penjualan'],
        $_POST['id_barang'],
        $_POST['kuantitas'],
        $_POST['harga_satuan'],
        $_POST['sub_total']
    );
    $_SESSION['message'] = "Data berhasil diubah!";
    header("Location: tampildetail_penjualan.php");
    exit;
}
?>

<?php
include "../templates/header.php";
include "../templates/sidebar.php";
include "../templates/topbar.php";
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Detail Penjualan</h1>
    <form method="post" action="">
        <input type="hidden" name="id_penjualan" value="<?= $detail_penjualan['ID_Penjualan']; ?>">
        <div class="form-group">
            <label for="id_barang">Barang</label>
            <select class="form-control" id="id_barang" name="id_barang">
                <?php
                $barang = $database->getBarang();
                foreach ($barang as $data) {
                    echo "<option value='" . $data['ID_Barang'] . "'";
                    if ($detail_penjualan['ID_Barang'] == $data['ID_Barang']) {
                        echo " selected";
                    }
                    echo ">" . $data['Nama_Barang'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="kuantitas">Kuantitas</label>
            <input type="number" class="form-control" id="kuantitas" name="kuantitas" value="<?= $detail_penjualan['Kuantitas']; ?>" required>
        </div>
        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= $detail_penjualan['HargaSatuan']; ?>" required>
        </div>
        <div class="form-group">
            <label for="sub_total">Sub Total</label>
            <input type="number" class="form-control" id="sub_total" name="sub_total" value="<?= $detail_penjualan['Sub_total']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="tampildetail_penjualan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
include "../templates/footer.php";
?>
