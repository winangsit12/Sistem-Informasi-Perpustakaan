<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa.xls");
?>

<table border="1">
    <tr>
        <th>No. </th>
        <th>Nama Siswa</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Jenis Kelamin</th>
    </tr>

    <?php
    require_once '../../config/db.php';
    $data = mysqli_query($conn, "SELECT * FROM users WHERE id_level = '2'");
    $no = 1;
    while ($siswa = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $siswa['nama']; ?></td>
            <td><?= $siswa['username']; ?></td>
            <td><?= $siswa['kelas']; ?></td>
            <td><?= $siswa['jenis_kelamin']; ?></td>
        </tr>
    <?php } ?>
</table>