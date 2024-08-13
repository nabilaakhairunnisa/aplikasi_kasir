<?php
session_start();
include "../templates/header.php";
include "../templates/sidebar.php";
include "../templates/topbar.php";
?>

<div class="container-fluid">

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-success' role='alert'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan</h6>
        </div>

        <div class="card-body">
            <a href="tambahdetail_penjualan.php" class="btn btn-primary mb-3">Tambah Detail Penjualan</a>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">ID Penjualan</th>
                            <th scope="col">ID Barang</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../db.php");
                        $database = new db();
                        $detailPenjualan = $database->getDetailPenjualan();
                        $count = 1;
                        while ($data = $detailPenjualan->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<th scope='row'>" . $count . ".</th>";
                            echo "<td>" . $data['ID_Penjualan'] . "</td>";
                            echo "<td>" . $data['ID_Barang'] . "</td>";
                            echo "<td>" . $data['Kuantitas'] . "</td>";
                            echo "<td>Rp. " . number_format($data['HargaSatuan'], 0, ',', '.') . "</td>";
                            echo "<td>Rp. " . number_format($data['Sub_total'], 0, ',', '.') . "</td>";
                            echo "<td>
                                <a href='editdetail_penjualan.php?id_penjualan=" . $data['ID_Penjualan'] . "&id_barang=" . $data['ID_Barang'] . "' class='btn btn-warning' onclick='return confirm(\"Edit detail penjualan?\")'>Edit</a>
                                <a href='hapusdetail_penjualan.php?id_penjualan=" . $data['ID_Penjualan'] . "&id_barang=" . $data['ID_Barang'] . "' class='btn btn-danger' onclick='return confirm(\"Hapus detail penjualan?\")'>Hapus</a>
                                </td>";
                            echo "</tr>";
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>
