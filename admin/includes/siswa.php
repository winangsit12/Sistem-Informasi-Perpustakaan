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
            <li class="breadcrumb-item active" aria-current="page">Siswa</li>
        </ol>
    </nav>
    <h2>Data Siswa</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <a href="includes/laporan_siswa_pdf.php" target="_blank" class="btn btn-outline-danger btn-sm float-left ml-3">Cetak PDF</a>
    <a href="includes/laporan_siswa_excel.php" target="_blank" class="btn btn-outline-success btn-sm float-left ml-3">Cetak Excel</a>
    <a href="?p=delete-siswa" onclick="return confirm('Yakin ingin menghapus semua data?')" class="btn btn-outline-danger btn-sm float-right">
        - &nbsp; Hapus Data
    </a>

    <!-- Button Trigger Modal Tambah Siswa-->
    <button type="button" class="btn btn-outline-info btn-sm float-right mr-3" data-bs-toggle="modal" data-bs-target="#tambahSiswa">
        + &nbsp; Tambah Data
    </button>
    <!-- Button Trigger Modal Import Siswa -->
    <button type="button" class="btn btn-outline-info btn-sm float-right mr-3" data-bs-toggle="modal" data-bs-target="#importSiswa">
        + &nbsp; Import Data
    </button>

    <a href="data-siswa.php" class="btn btn-light btn-sm float-right mr-3">
        &#x21BA;
    </a>
    <div class="float-right">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Data Siswa" autocomplete="off" required="required">
        </form>
    </div>

    <div class="clearfix"></div>

    <table class="table table-sm mt-3">
        <thead>
            <tr>
                <th>No. </th>
                <th>Nama Siswa</th>
                <th>Nomor Induk Siswa</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($siswa = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $siswa['nama']; ?></td>
                    <td><?= $siswa['username']; ?></td>
                    <td><?= $siswa['kelas']; ?></td>
                    <td><?= $siswa['jenis_kelamin']; ?></td>
                    <td>
                        <div class="d-inline">
                            <a href="?p=detail-siswa&id=<?= $siswa['id_user']; ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                            <a href="?p=edit-siswa&id=<?= $siswa['id_user']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                            <a href="?p=hapus-siswa&id=<?= $siswa['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-outline-danger btn-sm">Hapus</a>
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
                    <li class="page-item"><a class="page-link" style="text-decoration: none; color: black;" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
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

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/tambah_siswa_proses.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_level" value="2">
                    <input type="hidden" name="level" value="Anggota">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control">
                        <p>*Format jpg atau png</p>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" placeholder="Masukan Nama Siswa" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="username">Nomor Induk Siswa</label>
                        <input type="text" name="username" placeholder="Masukan Nomor Induk Siswa" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" placeholder="Masukan Password" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" name="kelas" placeholder="Masukan Kelas" class="form-control" required="" autocomplete="off">
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

<!-- Modal Import Siswa -->
<div class="modal fade" id="importSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Siswa</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/import_siswa_proses.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="excel_buku">File Import Siswa</label>
                        <input type="file" name="namafile" class="form-control" required="">
                        <p>*File harus memiliki ekstensi .xls</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="upload" value="upload" class="btn btn-outline-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>