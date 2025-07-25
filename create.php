<?php
<<<<<<< HEAD
include 'config.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Metode request harus POST"]);
    exit;
}

$contentType = $_SERVER["CONTENT_TYPE"] ?? '';

$nama = $alamat = $email = $ulasan = '';

// Jika input dari Postman (JSON)
if (strpos($contentType, "application/json") !== false) {
    $input  = json_decode(file_get_contents("php://input"), true);

    // Debug (optional): simpan input ke file
    // file_put_contents("debug.txt", print_r($input, true));

    $nama   = mysqli_real_escape_string($conn, $input['nama'] ?? '');
    $alamat = mysqli_real_escape_string($conn, $input['alamat'] ?? '');
    $email  = mysqli_real_escape_string($conn, $input['email'] ?? '');
    $ulasan = mysqli_real_escape_string($conn, $input['ulasan'] ?? '');

// Jika input dari FORM biasa
} else {
    $nama   = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');
    $email  = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $ulasan = mysqli_real_escape_string($conn, $_POST['ulasan'] ?? '');
}

// Validasi field wajib
if (empty($nama) || empty($alamat) || empty($email)) {
    if (strpos($contentType, "application/json") !== false) {
        echo json_encode(["error" => "Semua field wajib diisi!"]);
    } else {
        echo "Semua field wajib diisi!";
    }
    exit;
}

// Simpan ke database
$query = "INSERT INTO outsourcing (nama, alamat, email, ulasan)
          VALUES ('$nama', '$alamat', '$email', '$ulasan')";

if (mysqli_query($conn, $query)) {
    if (strpos($contentType, "application/json") !== false) {
        echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
    } else {
        // Jika dari form, redirect ke index.php
        header("Location: index.php");
        exit;
    }
} else {
    if (strpos($contentType, "application/json") !== false) {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
=======
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

include 'config.php';

// Ambil data dari JSON body
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Debug jika parsing gagal
if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Format JSON tidak valid atau kosong",
        "debug_raw" => $rawData
    ]);
    exit;
}

// Validasi input
if (
    isset($data["judul"]) && !empty($data["judul"]) &&
    isset($data["penulis"]) && !empty($data["penulis"]) &&
    isset($data["tanggal"]) && !empty($data["tanggal"]) &&
    isset($data["isi"]) && !empty($data["isi"])
) {
    $judul = mysqli_real_escape_string($coon, $data["judul"]);
    $penulis = mysqli_real_escape_string($coon, $data["penulis"]);
    $tanggal = mysqli_real_escape_string($coon, $data["tanggal"]);
    $isi = mysqli_real_escape_string($coon, $data["isi"]);

    $query = "INSERT INTO artikel (judul, penulis, tanggal, isi)
              VALUES ('$judul', '$penulis', '$tanggal', '$isi')";

    if (mysqli_query($coon, $query)) {
        echo json_encode(["success" => true, "message" => "Artikel berhasil ditambahkan"]);
    } else {
        echo json_encode(["success" => false, "message" => mysqli_error($coon)]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap",
        "received" => $data
    ]);
>>>>>>> 853987a058ee6cca15d4f6926483ad68d0477d55
}
?>
