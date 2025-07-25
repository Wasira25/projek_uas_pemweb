<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Metode request harus POST"]);
    exit;
}

$contentType = $_SERVER["CONTENT_TYPE"] ?? '';

if (strpos($contentType, "application/json") !== false) {
    $input = json_decode(file_get_contents("php://input"), true);
    $nama   = mysqli_real_escape_string($conn, $input['nama'] ?? '');
    $alamat = mysqli_real_escape_string($conn, $input['alamat'] ?? '');
    $email  = mysqli_real_escape_string($conn, $input['email'] ?? '');
    $ulasan = mysqli_real_escape_string($conn, $input['ulasan'] ?? '');
} else {
    $nama   = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');
    $email  = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $ulasan = mysqli_real_escape_string($conn, $_POST['ulasan'] ?? '');
}

if (empty($nama) || empty($alamat) || empty($email)) {
    if (strpos($contentType, "application/json") !== false) {
        echo json_encode(["error" => "Semua field wajib diisi!"]);
    } else {
        echo "Semua field wajib diisi!";
    }
    exit;
}

$query = "INSERT INTO outsourcing (nama, alamat, email, ulasan)
          VALUES ('$nama', '$alamat', '$email', '$ulasan')";

if (mysqli_query($conn, $query)) {
    if (strpos($contentType, "application/json") !== false) {
        echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
