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
        </ol>
    </nav>
    <h2>Data Admin</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <a href="includes/laporan_admin_pdf.php" target="_blank" class="btn btn-outline-danger btn-sm float-left ml-3">Cetak PDF</a>
    <a href="includes/laporan_admin_excel.php" target="_blank" class="btn btn-outline-success btn-sm float-left ml-3">Cetak Excel</a>
    <!-- Button Trigger Modal Tambah Admin-->
    <button type="button" class="btn btn-outline-info btn-sm float-right" data-bs-toggle="modal" data-bs-target="#tambahAdmin">
        + &nbsp; Tambah Data
    </button>
    <a href="data-admin.php" class="btn btn-light btn-sm float-right mr-3">
        &#x21BA;
    </a>
    <div class="float-right">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Data Admin" autocomplete="off" required="required">
        </form>
    </div>

    <div class="clearfix"></div>

    <table class="table table-sm mt-3">
        <thead>
            <tr>
                <th>No. </th>
                <th>Nama Admin</th>
                <th>Username</th>
                <th>Jenis Kelamin</th>
                <th>Sebagai</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($admin = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $admin['nama']; ?></td>
                    <td><?= $admin['username']; ?></td>
                    <td><?= $admin['jenis_kelamin']; ?></td>
                    <td><?= $admin['level']; ?></td>
                    <td>
                        <div class="d-inline">
                            <a href="?p=detail-admin&id=<?= $admin['id_user']; ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                            <a href="?p=edit-admin&id=<?= $admin['id_user']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                            <a href="?p=hapus-admin&id=<?= $admin['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-outline-danger btn-sm">Hapus</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php if (isset($_GET['cari'])) { ?>

    <?php } else { ?>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" style="text-decoration: none; color: black;" <?php if ($halaman > 1) {
                                                                                            echo "href='?halaman=$previous'";
                                                                                        } ?>>Previous</a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" style="text-decoration: none; color: black;"
                    href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" style="text-decoration: none; color: black;" <?php if ($halaman < $total_halaman) {
                                                                                            echo "href='?halaman=$next'";
                                                                                        } ?>>Next</a>
                </li>
            </ul>
        </nav>
    <?php } ?>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Admin</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/tambah_admin_proses.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_level" value="1">
                    <input type="hidden" name="level" value="Admin">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control">
                        <p>*Format jpg atau png</p>
                    </div>
                    <div class="form-group">
                        <label for="nama_admin">Nama Admin</label>
                        <input type="text" name="nama_admin" placeholder="Masukan Nama Admin" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Masukan Username" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Masukan Password" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="raw">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <table class="">
                            <tr>
                                <td><input type="radio" name="jenis_kelamin" value="Laki - laki" required=""> Laki - laki</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="jenis_kelamin" value="Perempuan" required=""> Perempuan</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>