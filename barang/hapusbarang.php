<?php
session_start();
include("../db.php");

if (isset($_GET['id_barang'])) {
    $db = new db();
    $id_barang = $_GET['id_barang'];
    
    if ($db->deleteBarang($id_barang)) {
        $_SESSION['message'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['message'] = "Gagal menghapus data: " . $db->koneksi->error;
    }
}

header("Location: tampilbarang.php");
exit;
