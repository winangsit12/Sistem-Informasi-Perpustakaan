<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Kembali.xls");
?>

<table border="1">
    <tr>
        <th>No. </th>
        <th>Judul Buku</th>
        <th>Nama Peminjam</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Ketepatan Waktu</th>
        <th>Keadaan Buku</th>
    </tr>

    <?php
    require_once '../../config/db.php';


    $bulan = $conn->real_escape_string($_POST['bulan']);
    $tahun = $conn->real_escape_string($_POST['tahun']);

    $data = mysqli_query($conn, "SELECT tanggal_pinjam, tanggal_kembali, ketepatan_waktu, keadaan_buku, buku.nama_buku, users.nama, users.username, users.kelas FROM pengembalian
    LEFT JOIN buku ON buku.id_buku = pengembalian.id_buku
    LEFT JOIN users ON users.id_user = pengembalian.id_user
    WHERE MONTH(tanggal_kembali) = '$bulan' AND YEAR(tanggal_kembali) = '$tahun'");
    $no = 1;
    while ($kembali = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $kembali['nama_buku']; ?></td>
            <td><?= $kembali['nama']; ?></td>
            <td><?= $kembali['username']; ?></td>
            <td><?= $kembali['kelas']; ?></td>
            <td><?= date('d-m-Y', strtotime($kembali['tanggal_pinjam'])); ?></td>
            <td><?= date('d-m-Y', strtotime($kembali['tanggal_kembali'])); ?></td>
            <td><?= $kembali['ketepatan_waktu']; ?></td>
            <td><?= $kembali['keadaan_buku']; ?></td>
        </tr>
    <?php } ?>
</table>