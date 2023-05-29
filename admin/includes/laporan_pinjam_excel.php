<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pinjam.xls");
?>

<table border="1">
    <tr>
        <th>No. </th>
        <th>Judul Buku</th>
        <th>Nama Peminjam</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Tanggal Pinjam</th>
    </tr>

    <?php
    require_once '../../config/db.php';
    $data = mysqli_query($conn, "SELECT peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, users.id_user, users.nama, users.username, users.kelas FROM peminjaman 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
    LEFT JOIN users ON users.id_user = peminjaman.id_user
    WHERE peminjaman.id_level = '2'");
    $no = 1;
    while ($pinjam = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $pinjam['nama_buku']; ?></td>
            <td><?= $pinjam['nama']; ?></td>
            <td><?= $pinjam['username']; ?></td>
            <td><?= $pinjam['kelas']; ?></td>
            <td><?= $pinjam['tanggal_pinjam']; ?></td>
        </tr>
    <?php } ?>
</table>