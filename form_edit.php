<?php
include 'config.php';
$id = $_GET['id'] ?? 0;
$result = mysqli_query($conn, "SELECT * FROM outsourcing WHERE id = $id");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head><title>Edit Data</title></head>
<body>
<h2>Form Edit Data Outsourcing</h2>
<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>
    Alamat: <input type="text" name="alamat" value="<?= $data['alamat'] ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $data['email'] ?>" required><br><br>
    Ulasan: <textarea name="ulasan"><?= $data['ulasan'] ?></textarea><br><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
