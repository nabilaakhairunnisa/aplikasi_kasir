<?php
session_start();
include("../db.php");

if (isset($_GET['id_penjualan'])) {
    $db = new db();
    $db->deletePenjualan($_GET['id_penjualan']);
    $_SESSION['message'] = "Data penjualan berhasil dihapus!";
}

header("Location: tampilpenjualan.php");
exit;
