<?php
<<<<<<< HEAD
=======
// Tampilkan semua error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Header untuk CORS & JSON
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Debug logging
$logData = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'headers' => getallheaders(),
    'body' => file_get_contents("php://input")
];
file_put_contents("debug-update.log", json_encode($logData, JSON_PRETTY_PRINT) . "\n", FILE_APPEND);

// Tangani preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

>>>>>>> 853987a058ee6cca15d4f6926483ad68d0477d55
include 'config.php';
header('Content-Type: application/json');

<<<<<<< HEAD
$method = $_SERVER['REQUEST_METHOD'];
$contentType = $_SERVER["CONTENT_TYPE"] ?? '';

$id = $nama = $alamat = $email = $ulasan = '';

// Jika dari browser (form HTML, method POST)
if ($method === 'POST') {
    $id     = intval($_POST['id'] ?? 0);
    $nama   = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');
    $email  = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $ulasan = mysqli_real_escape_string($conn, $_POST['ulasan'] ?? '');

    if ($id <= 0 || empty($nama) || empty($alamat) || empty($email)) {
        echo "Semua field wajib diisi!";
        exit;
    }

    $query = "UPDATE outsourcing SET 
                nama = '$nama', 
                alamat = '$alamat', 
                email = '$email', 
                ulasan = '$ulasan' 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
        exit;
    }

// Jika dari API Postman (PUT method)
} elseif ($method === 'PUT') {
    if (strpos($contentType, "application/json") !== false) {
        $input = json_decode(file_get_contents("php://input"), true);
    } else {
        parse_str(file_get_contents("php://input"), $input);
    }

    $id     = intval($input['id'] ?? 0);
    $nama   = mysqli_real_escape_string($conn, $input['nama'] ?? '');
    $alamat = mysqli_real_escape_string($conn, $input['alamat'] ?? '');
    $email  = mysqli_real_escape_string($conn, $input['email'] ?? '');
    $ulasan = mysqli_real_escape_string($conn, $input['ulasan'] ?? '');

    if ($id <= 0 || empty($nama) || empty($alamat) || empty($email)) {
        echo json_encode(["error" => "Semua field wajib diisi!"]);
        exit;
    }

    $query = "UPDATE outsourcing SET 
                nama = '$nama', 
                alamat = '$alamat', 
                email = '$email', 
                ulasan = '$ulasan' 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Data berhasil diupdate"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }

// Jika metode tidak dikenali
} else {
    echo json_encode(["error" => "Gunakan metode POST (form) atau PUT (API)"]);
=======
// Tangani request PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));

    if ($data && isset($data->id)) {
        $id = (int)$data->id;
        $judul = mysqli_real_escape_string($coon, $data->judul ?? '');
        $isi = mysqli_real_escape_string($coon, $data->isi ?? '');
        $penulis = mysqli_real_escape_string($coon, $data->penulis ?? '');
        $tanggal = mysqli_real_escape_string($coon, $data->tanggal ?? '');

        if (!$judul || !$isi || !$penulis || !$tanggal) {
            echo json_encode(["success" => false, "message" => "Semua field wajib diisi."]);
            exit();
        }

        $query = "UPDATE artikel SET judul='$judul', isi='$isi', penulis='$penulis', tanggal='$tanggal' WHERE id=$id";
        $result = mysqli_query($coon, $query);

        if ($result) {
            echo json_encode(["success" => true, "message" => "Artikel berhasil diupdate."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal update: " . mysqli_error($coon)]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "ID tidak ditemukan dalam request."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Hanya metode PUT yang diperbolehkan."]);
>>>>>>> 853987a058ee6cca15d4f6926483ad68d0477d55
}
?>
