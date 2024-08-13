<?php

class db
{
    public $koneksi;

    function __construct()
    {
        $this->koneksi = new mysqli("localhost", "root", "", "aplikasi_kasir");

        if ($this->koneksi->connect_error) {
            die("Koneksi gagal: " . $this->koneksi->connect_error);
        }
    }

    // CRUD untuk tabel kasir
    public function getKasir($username, $password)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM kasir WHERE Username = ? AND Password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getIdKasir($id_kasir)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM kasir WHERE ID_Kasir = ?");
        $stmt->bind_param("i", $id_kasir);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAllKasir()
    {
        return $this->koneksi->query("SELECT * FROM kasir");
    }

    public function createKasir($username, $namaKasir, $alamat, $nomorHP, $nomorKTP, $password)
    {
        return $this->koneksi->query("INSERT INTO kasir (Username, NamaKasir, Alamat, NomorHP, NomorKTP, Password) 
    VALUES ('$username', '$namaKasir', '$alamat', '$nomorHP', '$nomorKTP', '$password')");
    }

    public function updateKasir($id_kasir, $username, $namaKasir, $alamat, $nomorHP, $nomorKTP, $password)
    {
        return $this->koneksi->query("UPDATE kasir SET Username = '$username', NamaKasir = '$namaKasir', Alamat = '$alamat', 
    NomorHP = '$nomorHP', NomorKTP = '$nomorKTP', Password = '$password' WHERE ID_Kasir = '$id_kasir'");
    }

    public function deleteKasir($id_kasir)
    {
        return $this->koneksi->query("DELETE FROM kasir WHERE ID_Kasir = '$id_kasir'");
    }

    public function editKasir($id_kasir, $username, $namaKasir, $alamat, $nomorHP, $nomorKTP)
    {
        $stmt = $this->koneksi->prepare("UPDATE kasir SET Username = ?, NamaKasir = ?, Alamat = ?, NomorHP = ?, NomorKTP = ? WHERE ID_Kasir = ?");
        $stmt->bind_param("sssssi", $username, $namaKasir, $alamat, $nomorHP, $nomorKTP, $id_kasir);
        return $stmt->execute();
    }

    // CRUD untuk tabel barang
    public function getBarang()
    {
        $result = $this->koneksi->query("SELECT * FROM barang");
        if (!$result) {
            die("Query failed: " . $this->koneksi->error);
        }
        return $result;
    }

    public function getAllBarang()
    {
        return $this->koneksi->query("SELECT * FROM barang");
    }

    public function getBarangById($id_barang)
    {
        $id_barang = $this->koneksi->real_escape_string($id_barang);
        $result = $this->koneksi->query("SELECT * FROM barang WHERE ID_Barang = '$id_barang'");
        return $result->fetch_assoc();
    }


    public function createBarang($namaBarang, $satuan, $hargaSatuan)
    {
        return $this->koneksi->query("INSERT INTO barang (NamaBarang, Satuan, HargaSatuan) 
    VALUES ('$namaBarang', '$satuan', '$hargaSatuan')");
    }

    public function updateBarang($id_barang, $namaBarang, $satuan, $hargaSatuan)
    {
        return $this->koneksi->query("UPDATE barang SET NamaBarang = '$namaBarang', Satuan = '$satuan', HargaSatuan = '$hargaSatuan' 
    WHERE ID_Barang = '$id_barang'");
    }

    public function deleteBarang($id_barang)
    {
        return $this->koneksi->query("DELETE FROM barang WHERE ID_Barang = '$id_barang'");
    }

    // CRUD untuk tabel shift
    public function getShift($id_shift)
    {
        $id_shift = $this->koneksi->real_escape_string($id_shift);
        $result = $this->koneksi->query("SELECT * FROM shift WHERE ID_Shift = '$id_shift'");
        return $result->fetch_assoc();
    }

    public function getAllShifts() {
        return $this->koneksi->query("SELECT * FROM shift");
    }
    
    public function createShift($id_kasir, $waktuBuka, $saldoAwal, $jumlahPenjualan, $saldoAkhir, $waktuTutup, $status)
    {
        return $this->koneksi->query("INSERT INTO shift (ID_Kasir, WaktuBuka, SaldoAwal, JumlahPenjualan, SaldoAkhir, WaktuTutup, Status) 
    VALUES ('$id_kasir', '$waktuBuka', '$saldoAwal', '$jumlahPenjualan', '$saldoAkhir', '$waktuTutup', '$status')");
    }

    public function updateShift($id_shift, $id_kasir, $waktuBuka, $saldoAwal, $jumlahPenjualan, $saldoAkhir, $waktuTutup, $status)
    {
        return $this->koneksi->query("UPDATE shift SET ID_Kasir = '$id_kasir', WaktuBuka = '$waktuBuka', SaldoAwal = '$saldoAwal', 
    JumlahPenjualan = '$jumlahPenjualan', SaldoAkhir = '$saldoAkhir', WaktuTutup = '$waktuTutup', Status = '$status' 
    WHERE ID_Shift = '$id_shift'");
    }

    public function deleteShift($id_shift)
    {
        return $this->koneksi->query("DELETE FROM shift WHERE ID_Shift = '$id_shift'");
    }

    // CRUD untuk tabel penjualan
    public function getAllPenjualan()
    {
        return $this->koneksi->query("SELECT * FROM penjualan");
    }

    public function getPenjualan($id_penjualan) {
        // Sanitize input to prevent SQL injection
        $id_penjualan = $this->koneksi->real_escape_string($id_penjualan);
        
        // Prepare SQL query to fetch the penjualan record
        $query = "SELECT * FROM penjualan WHERE ID_Penjualan = '$id_penjualan'";
        
        // Execute the query and return the result
        $result = $this->koneksi->query($query);
        
        if ($result->num_rows > 0) {
            // Fetch the record as an associative array
            return $result->fetch_assoc();
        } else {
            // Return null if no record found
            return null;
        }
    }

    public function createPenjualan($waktuTransaksi, $total, $id_shift)
    {
        return $this->koneksi->query("INSERT INTO penjualan (WaktuTransaksi, Total, ID_Shift) 
    VALUES ('$waktuTransaksi', '$total', '$id_shift')");
    }

    public function updatePenjualan($id_penjualan, $waktuTransaksi, $total, $id_shift)
    {
        return $this->koneksi->query("UPDATE penjualan SET WaktuTransaksi = '$waktuTransaksi', Total = '$total', ID_Shift = '$id_shift' 
    WHERE ID_Penjualan = '$id_penjualan'");
    }

    public function deletePenjualan($id_penjualan)
    {
        return $this->koneksi->query("DELETE FROM penjualan WHERE ID_Penjualan = '$id_penjualan'");
    }

    // CRUD untuk tabel detail_penjualan
    public function getDetailPenjualan()
    {
        return $this->koneksi->query("SELECT * FROM detail_penjualan");
    }

    public function createDetailPenjualan($id_penjualan, $id_barang, $kuantitas, $hargaSatuan, $sub_total)
    {
        return $this->koneksi->query("INSERT INTO detail_penjualan (ID_Penjualan, ID_Barang, Kuantitas, HargaSatuan, Sub_total) 
    VALUES ('$id_penjualan', '$id_barang', '$kuantitas', '$hargaSatuan', '$sub_total')");
    }

    public function updateDetailPenjualan($id_penjualan, $id_barang, $kuantitas, $hargaSatuan, $sub_total)
    {
        return $this->koneksi->query("UPDATE detail_penjualan SET ID_Barang = '$id_barang', Kuantitas = '$kuantitas', HargaSatuan = '$hargaSatuan', 
    Sub_total = '$sub_total' WHERE ID_Penjualan = '$id_penjualan'");
    }

    public function deleteDetailPenjualan($id_penjualan, $id_barang)
    {
        return $this->koneksi->query("DELETE FROM detail_penjualan WHERE ID_Penjualan = '$id_penjualan' AND ID_Barang = '$id_barang'");
    }
}
