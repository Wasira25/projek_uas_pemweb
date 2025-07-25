<?php
include 'config.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$contentType = $_SERVER["CONTENT_TYPE"] ?? '';

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
              nama = '$nama', alamat = '$alamat', email = '$email', ulasan = '$ulasan' 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }

} elseif ($method === 'PUT') {
    $input = json_decode(file_get_contents("php://input"), true);

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
              nama = '$nama', alamat = '$alamat', email = '$email', ulasan = '$ulasan' 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Data berhasil diupdate"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["error" => "Gunakan POST (form) atau PUT (API)"]);
}
?>
