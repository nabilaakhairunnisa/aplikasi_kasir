<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_penjualan = $_POST['id_penjualan'];
    $id_barang    = $_POST['id_barang'];
    $kuantitas    = $_POST['kuantitas'];
    $harga_satuan = $_POST['harga_satuan'];
    $sub_total    = $_POST['sub_total'];

    $database = new db();
    $database->createDetailPenjualan($id_penjualan, $id_barang, $kuantitas, $harga_satuan, $sub_total);
    $_SESSION['message'] = "Data berhasil disimpan!";

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
    <h1 class="h3 mb-4 text-gray-800">Tambah Detail Penjualan</h1>

    <form method="post" action="">
        <div class="form-group">
            <label for="id_penjualan">ID Penjualan</label>
            <select class="form-control" id="id_penjualan" name="id_penjualan" required>
                <option>Pilih ID Penjualan</option>
                <?php
                $database = new db();
                $penjualan = $database->getAllPenjualan();

                while ($data = $penjualan->fetch_assoc()) {
                    echo "<option value='" . $data['ID_Penjualan'] . "'>" . $data['ID_Penjualan'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_barang">ID Barang</label>
            <select class="form-control" id="id_barang" name="id_barang" required>
                <option>Pilih ID Barang</option>
                <?php
                $barang = $database->getAllBarang();

                while ($data = $barang->fetch_assoc()) {
                    echo "<option value='" . $data['ID_Barang'] . "'>" . $data['Nama_Barang'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="kuantitas">Kuantitas</label>
            <input type="number" class="form-control" id="kuantitas" name="kuantitas" placeholder="Masukkan kuantitas" required>
        </div>
        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" placeholder="Masukkan harga satuan" required>
        </div>
        <div class="form-group">
            <label for="sub_total">Sub Total</label>
            <input type="number" class="form-control" id="sub_total" name="sub_total" placeholder="Masukkan sub total" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="tampildetail_penjualan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
include "../templates/footer.php";
?>
