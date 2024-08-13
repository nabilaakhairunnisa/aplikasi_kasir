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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Shift</h6>
        </div>

        <div class="card-body">
            <a href="tambahshift.php" class="btn btn-primary mb-3">Tambah Shift</a>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">ID Shift</th>
                            <th scope="col">ID Kasir</th>
                            <th scope="col">Waktu Buka</th>
                            <th scope="col">Saldo Awal</th>
                            <th scope="col">Jumlah Penjualan</th>
                            <th scope="col">Saldo Akhir</th>
                            <th scope="col">Waktu Tutup</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../db.php");
                        $database = new db();
                        $shifts = $database->getAllShifts();
                        $count = 1;
                        while ($data = $shifts->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<th scope='row'>" . $count . ".</th>";
                            echo "<td>" . ($data['ID_Shift']) . "</td>";
                            echo "<td>" . ($data['ID_Kasir']) . "</td>";
                            echo "<td>" . ($data['WaktuBuka']) . "</td>";
                            echo "<td>Rp. " . number_format($data['SaldoAwal'], 0, ',', '.') . "</td>";
                            echo "<td>" . ($data['JumlahPenjualan']) . "</td>";
                            echo "<td>Rp. " . number_format($data['SaldoAkhir'], 0, ',', '.') . "</td>";
                            echo "<td>" . ($data['WaktuTutup']) . "</td>";
                            echo "<td>" . ($data['Status']) . "</td>";
                            echo "<td>
                    <a href='editshift.php?id_shift=" . $data['ID_Shift'] . "' class='btn btn-warning'>Edit</a>
                    <a href='hapusshift.php?id_shift=" . ($data['ID_Shift'] ?? '#') . "' class='btn btn-danger' onclick='return confirm(\"Hapus data?\")'>Hapus</a>
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

    <?php
    include "../templates/footer.php";
    ?>