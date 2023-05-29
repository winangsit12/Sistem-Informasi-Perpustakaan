<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Admin.xls");
?>

<table border="1">
    <tr>
        <th>No. </th>
        <th>Nama Admin</th>
        <th>Username</th>
        <th>Jenis Kelamin</th>
        <th>Hak Akses</th>
    </tr>

    <?php
    require_once '../../config/db.php';
    $data = mysqli_query($conn, "SELECT * FROM users WHERE id_level = '1'");
    $no = 1;
    while ($admin = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $admin['nama']; ?></td>
            <td><?= $admin['username']; ?></td>
            <td><?= $admin['jenis_kelamin']; ?></td>
            <td><?= $admin['level']; ?></td>
        </tr>
    <?php } ?>
</table>