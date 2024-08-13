<?php
session_start();
include("../db.php");

if (isset($_GET['id_penjualan']) && isset($_GET['id_barang'])) {
    $db = new db();
    $db->deleteDetailPenjualan($_GET['id_penjualan'], $_GET['id_barang']);
    $_SESSION['message'] = "Data berhasil dihapus!";
}

header("Location: tampildetail_penjualan.php");
exit;
?>
