<?php
<<<<<<< HEAD
include 'config.php';

header('Content-Type: application/json');

// Jika request dari browser pakai GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM outsourcing WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        // Tampilkan pesan biasa di browser
        echo "<script>alert('Data berhasil dihapus'); window.location.href='index.php';</script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
    exit;
}

// Jika request DELETE dari Postman
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';

    if (strpos($contentType, "application/json") !== false) {
        $input = json_decode(file_get_contents("php://input"), true);
        $id = intval($input['id'] ?? 0);
    } else {
        parse_str(file_get_contents("php://input"), $input);
        $id = intval($input['id'] ?? 0);
    }

    if ($id <= 0) {
        echo json_encode(["error" => "ID tidak valid"]);
        exit;
    }

    $query = "DELETE FROM outsourcing WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Data berhasil dihapus"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
    exit;
}

// Jika metode tidak dikenali
echo json_encode(["error" => "Gunakan metode GET (untuk web) atau DELETE (untuk API/Postman)"]);
=======
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Debug logging
$logData = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'headers' => getallheaders(),
    'body' => file_get_contents("php://input")
];
file_put_contents("debug-delete.log", json_encode($logData, JSON_PRETTY_PRINT) . "\n", FILE_APPEND);

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

include 'config.php';

// 1. Jika pakai DELETE dari Postman / frontend
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $id = (int) $data->id;
        $query = "DELETE FROM artikel WHERE id=$id";
        $result = mysqli_query($coon, $query);

        if ($result) {
            echo json_encode(["success" => true, "message" => "Artikel berhasil dihapus"]);
        } else {
            echo json_encode(["success" => false, "message" => mysqli_error($coon)]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "ID tidak ditemukan"]);
    }
    exit();
}

// 2. Jika pakai URL biasa (GET) seperti delete.php?id=5
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($id <= 0) {
        echo json_encode(["success" => false, "message" => "ID tidak valid"]);
        exit();
    }

    $query = "DELETE FROM artikel WHERE id=$id";
    $result = mysqli_query($coon, $query);

    if ($result) {
        // Redirect back to index.php after successful deletion
        header("Location: index.php");
        exit();
    } else {
        error_log("MySQL error on delete: " . mysqli_error($coon));
        echo json_encode(["success" => false, "message" => mysqli_error($coon)]);
        exit();
    }
}

// Jika metode tidak didukung
echo json_encode(["success" => false, "message" => "Metode tidak didukung atau ID tidak ada"]);
>>>>>>> 853987a058ee6cca15d4f6926483ad68d0477d55
