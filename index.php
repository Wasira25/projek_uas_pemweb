<?php
include 'config.php';
$result = mysqli_query($conn, "SELECT * FROM outsourcing");
?>

<!DOCTYPE html>
<html>
<head><title>Data Outsourcing</title></head>
<body>
<h2>Data Outsourcing</h2>
<a href="form_create.php">Tambah Data</a><br><br>

<table border="1" cellpadding="8">
    <tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Ulasan</th><th>Aksi</th></tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['ulasan'] ?></td>
        <td>
            <a href="form_edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
