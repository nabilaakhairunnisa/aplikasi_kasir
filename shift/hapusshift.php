<?php
session_start();
include("../db.php");

// Create a new instance of the db class
$db = new db();

// Check if the id_shift parameter is set in the URL
if (isset($_GET['id_shift'])) {
    // Call the deleteShift method with the provided id_shift
    $id_shift = $_GET['id_shift'];
    
    if ($db->deleteShift($id_shift)) {
        $_SESSION['message'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['message'] = "Gagal menghapus data: " . $db->koneksi->error;
    }
}

// Redirect to the shift.php page
header("Location: tampilshift.php");
exit;
