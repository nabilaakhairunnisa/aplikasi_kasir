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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Penjualan</h6>
        </div>

        <div class="card-body">
            <a href="tambahpenjualan.php" class="btn btn-primary mb-3">Tambah</a>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">ID Penjualan</th>
                            <th scope="col">Waktu Transaksi</th>
                            <th scope="col">Total</th>
                            <th scope="col">ID Shift</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../db.php");
                        $database = new db();
                        $penjualan = $database->getAllPenjualan();
                        $count = 1;
                        while ($data = $penjualan->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<th scope='row'>" . $count . ".</th>";
                            echo "<td>" . $data['ID_Penjualan'] . "</td>";
                            echo "<td>" . $data['WaktuTransaksi'] . "</td>";
                            echo "<td>Rp. " . number_format($data['Total'], 0, ',', '.') . "</td>";
                            echo "<td>" . $data['ID_Shift'] . "</td>";
                            echo "<td>
                    <a href='editpenjualan.php?id_penjualan=" . $data['ID_Penjualan'] . "' class='btn btn-warning'>Edit</a>
                    <a href='hapuspenjualan.php?id_penjualan=" . $data['ID_Penjualan'] . "' class='btn btn-danger' onclick='return confirm(\"Hapus data?\")'>Hapus</a>
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