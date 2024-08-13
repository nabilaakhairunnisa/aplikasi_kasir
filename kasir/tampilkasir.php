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
            <h6 class="m-0 font-weight-bold text-primary">Data Kasir</h6>
        </div>

        <div class="card-body">
            <a href="tambahkasir.php" class="btn btn-primary mb-3">Tambah Kasir</a>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">ID Kasir</th> 
                            <th scope="col">Username</th>
                            <th scope="col">Nama Kasir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Nomor KTP</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../db.php");
                        $database = new db();
                        $kasir = $database->getAllKasir();
                        $count = 1;
                        foreach ($kasir as $data) {
                            echo "<tr class='text-center'>";
                            echo "<th scope='row'>" . $count . ".</th>";
                            echo "<td>" . $data['ID_Kasir'] . "</td>";
                            echo "<td>" . $data['Username'] . "</td>";
                            echo "<td>" . $data['NamaKasir'] . "</td>";
                            echo "<td>" . $data['Alamat'] . "</td>";
                            echo "<td>" . $data['NomorHP'] . "</td>";
                            echo "<td>" . $data['NomorKTP'] . "</td>";
                            echo "<td>
                                    <a href='editkasir.php?id_kasir=" . $data['ID_Kasir'] . "' class='btn btn-warning'>Edit</a>
                                    <a href='hapuskasir.php?id_kasir=" . $data['ID_Kasir'] . "' class='btn btn-danger' onclick='return confirm(\"Hapus data?\")'>Hapus</a>
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