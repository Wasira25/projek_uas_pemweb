<?php
<<<<<<< HEAD
include 'config.php';
$result = mysqli_query($conn, "SELECT * FROM outsourcing");
=======
// Aktifkan error agar jika ada masalah, muncul
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

$result = mysqli_query($coon, "SELECT * FROM artikel ORDER BY id DESC");
>>>>>>> 853987a058ee6cca15d4f6926483ad68d0477d55
?>

<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
    <title>Data Outsourcing</title>
</head>
<body>
    <h2>Daftar Data Outsourcing</h2>
    <a href="form_create.php">+ Tambah Data</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Ulasan</th><th>Aksi</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['ulasan'] ?></td>
            <td>
                <a href="form_edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
=======
  <title>Manajemen Artikel Kampus</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background-color: #f0f0f0; }
    a { text-decoration: none; color: blue; }
    .btn { padding: 6px 12px; background: #007bff; color: white; border: none; text-decoration: none; }
  </style>
</head>
<body>
  <h2>📰 Daftar Artikel Kampus</h2>
  <a href="form_create.php" class="btn">➕ Tambah Artikel</a>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php $no = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= htmlspecialchars($row['penulis']) ?></td>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
            <td>
              <a href="form_edit.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
              <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5">Belum ada artikel.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
>>>>>>> 853987a058ee6cca15d4f6926483ad68d0477d55
</body>
</html>
