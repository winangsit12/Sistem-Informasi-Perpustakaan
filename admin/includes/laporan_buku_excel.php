<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Buku.xls");
?>


<table border="1">
    <tr>
        <th>No. </th>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Tahun Terbit</th>
        <th>Deskripsi</th>
        <th>Sinopsis</th>
        <th>Jumlah Buku</th>
    </tr>

    <?php
    require_once '../../config/db.php';
    $data = mysqli_query($conn, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
    $no = 1;
    while ($buku = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $buku['nama_buku']; ?></td>
            <td><?= $buku['pengarang']; ?></td>
            <td><?= $buku['penerbit']; ?></td>
            <td><?= $buku['tahun_terbit']; ?></td>
            <td><?= $buku['deskripsi']; ?></td>
            <td><?= $buku['sinopsis']; ?></td>
            <td><?= $buku['jumlah']; ?></td>
        </tr>
    <?php } ?>
</table>