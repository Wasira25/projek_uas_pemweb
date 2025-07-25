<?php
include 'config.php';
header('Content-Type: application/json');

// Hapus dari browser
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM outsourcing WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
    exit;
}

// Hapus dari Postman (DELETE method)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $input = json_decode(file_get_contents("php://input"), true);
    $id = intval($input['id'] ?? 0);

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

echo json_encode(["error" => "Gunakan metode GET (web) atau DELETE (API)"]);
?>
