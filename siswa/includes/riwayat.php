<div class="container mt-4">
    <h2>Riwayat Pinjam Saya</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>

    <div class="float-right mr-3 mb-3">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Riwayat Peminjaman" autocomplete="off">
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
                    <th>Tanggal Kembali</th>
                    <th>Ketepatan Waktu</th>
                    <th>Keadaan Buku</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($kembali = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $kembali['nama_buku']; ?></td>
                        <td><?= $kembali['kategori']; ?></td>
                        <td><?= $kembali['tanggal_pinjam']; ?></td>
                        <td><?= $kembali['tanggal_kembali']; ?></td>
                        <td><?= $kembali['ketepatan_waktu']; ?></td>
                        <td><?= $kembali['keadaan_buku']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>