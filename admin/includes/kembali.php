<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
            <li class="breadcrumb-item active" aria-current="page">Kembalikan Buku</li>
        </ol>
    </nav>

    <h2>Kembalikan Buku</h2>
    <hr>

    <a href="../admin/data-pinjam.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <br>

    <div class="clear-fix card mx-auto mt-4 mb-4 col-sm-10">
        <?php
        //mengambil data buku
        $pinjam = $conn->query("SELECT id_pinjam, peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, users.id_user, users.nama FROM peminjaman 
        LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
        LEFT JOIN users ON users.id_user = peminjaman.id_user
        WHERE id_pinjam = '$_GET[id]'");
        $data = $pinjam->fetch_assoc();

        //menghitung lama peminjaman
        $lama = $conn->query("SELECT COUNT(id_pinjam) FROM peminjaman WHERE DATEDIFF(estimasi, NOW()) < 0 AND id_pinjam = '$_GET[id]'");
        $hitung = $lama->fetch_array();
        ?>

        <form action="../proses/kembali_buku_proses.php" method="POST" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id_pinjam']; ?>">
            <input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">
            <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
            <input type="hidden" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam']; ?>">
            <div class="form-group">
                <label for="ketepatan_waktu">Ketepatan Waktu</label>
                <?php
                if ($hitung['COUNT(id_pinjam)'] == '0') {
                ?>
                    <input type="text" name="ketepatan_waktu" class="form-control" value="Tepat Waktu" placeholder="Tepat Waktu" required="" readonly>
                <?php
                } else if ($hitung['COUNT(id_pinjam)'] >= '1') {
                ?>
                    <input type="text" name="ketepatan_waktu" class="form-control" value="Terlambat" placeholder="Terlambat" required="" readonly>
                <?php
                }
                ?>

                </select>
            </div>
            <div class="form-group">
                <label for="keadaan_buku">Keadaan Buku</label>
                <select name="keadaan_buku" class="form-control" autofocus-required>
                    <option selected disabled value="">-- Pilih Keadaan Buku</option>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-outline-success">Simpan</button>
            </div>
        </form>
    </div>
</div>