<div class="container">

    <?php
    if (isset($_SESSION['pesan'])) {
        echo $_SESSION['pesan'];
        unset($_SESSION['pesan']);
    }
    ?>

    <h2 class="mt-4">Akun Saya</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    </br>

    <div class="clear-fix card mx-auto mt-4 mb-4 col-sm-10">
        <form action="../proses/edit_akun_proses.php" method="POST" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
            <input type="hidden" name="id_level" value="<?= $data['id_level'] ?>">
            <input type="hidden" name="password" value="<?= $data['password'] ?>">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <label>Foto</label> <br>
                        <img src="../foto/<?= $data['foto']; ?>" style="width: 180px;"> <br>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" value="<?= $data['nama'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nomor Induk Siswa</label>
                        <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" class="form-control" value="<?= $data['kelas'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" class="form-control" value="<?= $data['jenis_kelamin'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Sebagai</label>
                        <input type="text" name="level" class="form-control" value="<?= $data['level'] ?>" readonly>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary float-right mt-3 mb-3 mr-3" data-bs-toggle="modal" data-bs-target="#gantiPass">Ganti Password</button>
        </form>
    </div>
</div>

<!-- Modal Ganti Password Siswa -->
<div class="modal fade" id="gantiPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Password Siswa</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/password_akun_proses.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="username" value="<?= $data['username'] ?>">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" name="password_lama" placeholder="Masukan Password Lama" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" name="password_baru" placeholder="Masukan Password Baru" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="konfirm_password">Konfirmasi Password Baru</label>
                        <input type="password" name="konfirm_password" placeholder="Konfirmasi Password Baru" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan_password" class="btn btn-outline-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>