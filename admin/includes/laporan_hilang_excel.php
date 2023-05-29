<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Buku Tidak Kembali.xls");
?>

<table border="1">
    <tr>
        <th>No. </th>
        <th>Judul Buku</th>
        <th>Nama Peminjam</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Tanggal Pinjam</th>
        <th>Status Peminjam</th>
        <th>Keterangan</th>
    </tr>

    <?php
    require_once '../../config/db.php';

    $bulan = $conn->real_escape_string($_POST['bulan']);
    $tahun = $conn->real_escape_string($_POST['tahun']);

    $data = mysqli_query($conn, "SELECT tanggal_pinjam, status_peminjam, keterangan, buku.nama_buku, users.nama, users.username, users.kelas FROM hilang
    LEFT JOIN buku ON buku.id_buku = hilang.id_buku
    LEFT JOIN users ON users.id_user = hilang.id_user
    WHERE MONTH(tanggal_pinjam) = '$bulan' AND YEAR(tanggal_pinjam) = '$tahun'");
    $no = 1;
    while ($hilang = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $hilang['nama_buku']; ?></td>
            <td><?= $hilang['nama']; ?></td>
            <td><?= $hilang['username']; ?></td>
            <td><?= $hilang['kelas']; ?></td>
            <td><?= date('d-m-Y', strtotime($hilang['tanggal_pinjam'])); ?></td>
            <td><?= $hilang['status_peminjam']; ?></td>
            <td><?= $hilang['keterangan']; ?></td>
        </tr>
    <?php } ?>
</table>