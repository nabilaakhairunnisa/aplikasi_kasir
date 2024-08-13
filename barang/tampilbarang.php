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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
        </div>

        <div class="card-body">
            <a href="tambahbarang.php" class="btn btn-primary mb-3">Tambah Barang</a>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">ID Barang</th> 
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../db.php");
                        $database = new db();
                        $barang = $database->getBarang();
                        $count = 1;
                        while ($data = $barang->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<th scope='row'>" . $count . ".</th>";
                            echo "<td>" . $data['ID_Barang'] . "</td>"; 
                            echo "<td>" . $data['NamaBarang'] . "</td>";
                            echo "<td>" . $data['Satuan'] . "</td>";
                            echo "<td>Rp. " . number_format($data['HargaSatuan'], 0, ',', '.') . "</td>";
                            echo "<td>
                    <a href='editbarang.php?id_barang=" . $data['ID_Barang'] . "' class='btn btn-warning'>Edit</a>
                    <a href='hapusbarang.php?id_barang=" . $data['ID_Barang'] . "' class='btn btn-danger' onclick='return confirm(\"Hapus data?\")'>Hapus</a>
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
