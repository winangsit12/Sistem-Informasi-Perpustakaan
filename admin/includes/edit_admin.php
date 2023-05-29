<div class="container">

    <?php
    if (isset($_SESSION['pesan'])) {
        echo $_SESSION['pesan'];
        unset($_SESSION['pesan']);
    }
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <h2>Edit Data Admin</h2>
    <hr>

    <a href="../admin/data-admin.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    </br>

    <div class="clear-fix card mx-auto mt-4 mb-4 col-sm-10">
        <?php
        //mengambil data admin yang akan diubah
        $admin = $conn->query("SELECT * FROM users WHERE id_user = '$_GET[id]'");
        $data = $admin->fetch_assoc();
        ?>

        <form action="../proses/edit_admin_proses.php" method="POST" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
            <input type="hidden" name="kelas" value="<?= $data['kelas'] ?>">
            <input type="hidden" name="id_level" value="<?= $data['id_level'] ?>">
            <input type="hidden" name="level" value="<?= $data['level'] ?>">
            <input type="hidden" name="password" value="<?= $data['password'] ?>">
            <div class="form-group">
                <label>Foto</label> <br>
                <img src="../foto/<?= $data['foto']; ?>" style="width: 120px;"> <br>
                <input type="file" name="foto" class="mt-2">
            </div>
            <div class="form-group">
                <label>Nama Admin</label>
                <input type="text" name="nama_admin" class="form-control" value="<?= $data['nama'] ?>" placeholder="Masukan Nama Admin" required="">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" placeholder="Masukan Username" required="">
            </div>
            <div class="raw">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <table class="">
                    <tr>
                        <td><input type="radio" name="jenis_kelamin" value="Laki - laki" <?php if ($data['jenis_kelamin'] == 'Laki - laki') echo 'checked' ?>> Laki - laki</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan') echo 'checked' ?>> Perempuan</td>
                    </tr>
                </table>
            </div>
            <button type="submit" name="simpan" class="btn btn-outline-success float-right mb-3 mr-3">Simpan</button>
            <button type="button" class="btn btn-outline-primary float-right mb-3 mr-3" data-bs-toggle="modal" data-bs-target="#passAdmin">Ganti Password</button>
        </form>
    </div>
</div>

<!-- Modal Ganti Password Admin -->
<div class="modal fade" id="passAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Password Admin</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/password_admin_proses.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="username" value="<?= $data['username'] ?>">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="text" name="password_lama" placeholder="Masukan Password Lama" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="text" name="password_baru" placeholder="Masukan Password Baru" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="konfirm_password">Konfirmasi Password Baru</label>
                        <input type="text" name="konfirm_password" placeholder="Konfirmasi Password Baru" class="form-control" required="">
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