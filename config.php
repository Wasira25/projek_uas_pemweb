<?php
// WAJIB: aktifkan semua error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Konfigurasi database
$host = "localhost";
$user = "root";
$pass = "";
<<<<<<< HEAD
$db   = "db_jasa";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
=======
$db   = "kampus_db"; // Pastikan database ini ADA

// Coba koneksi
$coon = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$coon) {
  // Paksa tampilkan error dan berhenti
  die("Koneksi gagal: " . mysqli_connect_error());
>>>>>>> 853987a058ee6cca15d4f6926483ad68d0477d55
}
?>
