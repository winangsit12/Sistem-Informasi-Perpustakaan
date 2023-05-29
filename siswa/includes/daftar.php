<div class="container mt-4">
    <?php
    if (isset($_SESSION['pesan'])) {
        echo $_SESSION['pesan'];
        unset($_SESSION['pesan']);
    }
    ?>

    <h2>Daftar Pinjam Saya</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>

    <div class="float-right mr-3 mb-3">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Daftar Peminjaman" autocomplete="off">
        </form>
    </div>

    <div class="clearfix">

        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Judul Buku</th>
                    <th>Kategori Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Pengembalian</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($pinjam = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <?php if ($pinjam['id_level'] == 1) { ?>
                            <td><?= $no++; ?></td>
                            <td><?= $pinjam['nama_buku']; ?></td>
                            <td><?= $pinjam['kategori']; ?></td>
                            <td>Tanggal peminjaman belum diatur</td>
                            <td>Batas pengembalian belum diatur</td>
                            <td>Buku belum dipinjam saat ini</td>
                            <td>
                                <a href="?p=batal-pinjam&id=<?= $pinjam['id_pinjam']; ?>" onclick="return confirm('Yakin ingin membatalkan izin pinjam?')" class="btn btn-outline-danger btn-sm">Batal Pinjam</a>
                            </td>
                        <?php } else if ($pinjam['id_level'] == 2) { ?>
                            <td><?= $no++; ?></td>
                            <td><?= $pinjam['nama_buku']; ?></td>
                            <td><?= $pinjam['kategori']; ?></td>
                            <td><?= date('d-m-Y', strtotime($pinjam['tanggal_pinjam'])); ?></td>
                            <td><?= date('d-m-Y', strtotime($pinjam['estimasi'])); ?></td>
                            <td>Buku sudah dalam masa peminjaman</td>
                            <td>
                                -
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>