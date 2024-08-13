<?php
session_start();
include("../db.php");

if (isset($_GET['id_kasir'])) {
    $db = new db();
    $db->deleteKasir($_GET['id_kasir']);
    $_SESSION['message'] = "Data kasir berhasil dihapus!";
}

header("Location: tampilkasir.php");
exit;
