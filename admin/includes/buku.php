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
            <li class="breadcrumb-item active" aria-current="page">Buku</li>
        </ol>
    </nav>
    <h2>Data Buku</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <a href="includes/laporan_buku_pdf.php" target="_blank" class="btn btn-outline-danger btn-sm float-left ml-3">Cetak PDF</a>
    <a href="includes/laporan_buku_excel.php" target="_blank" class="btn btn-outline-success btn-sm float-left ml-3">Cetak Excel</a>

    <!-- Button Trigger Modal Tambah Buku-->
    <button type="button" class="btn btn-outline-info btn-sm float-right" data-bs-toggle="modal" data-bs-target="#tambahBuku">
        + &nbsp; Tambah Data
    </button>
    <!-- Button Trigger Modal Import Buku -->
    <button type="button" class="btn btn-outline-info btn-sm float-right mr-3" data-bs-toggle="modal" data-bs-target="#importBuku">
        + &nbsp; Import Data
    </button>

    <a href="data-buku.php" class="btn btn-light btn-sm float-right mr-3">
        &#x21BA;
    </a>
    <div class="float-right">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Data Buku" autocomplete="off" required="required">
        </form>
    </div>

    <div class="clearfix"></div>

    <table class="table table-sm mt-3">
        <thead>
            <tr>
                <th>No. </th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th class="text-center">Tahun Terbit</th>
                <th class="text-center">Jumlah Buku</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($buku = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $buku['nama_buku']; ?></td>
                    <td><?= $buku['pengarang']; ?></td>
                    <td><?= $buku['penerbit']; ?></td>
                    <td class="text-center"><?= $buku['tahun_terbit']; ?></td>
                    <td class="text-center"><?= $buku['jumlah']; ?></td>
                    <td class="text-center">
                        <div class="d-inline">
                            <a href="?p=detail-buku&id=<?= $buku['id_buku']; ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                            <a href="?p=edit-buku&id=<?= $buku['id_buku']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                            <a href="?p=hapus-buku&id=<?= $buku['id_buku']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-outline-danger btn-sm">Hapus</a>
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

<!-- Modal Tambah Buku -->
<div class="modal fade" id="tambahBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Buku</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/tambah_buku_proses.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sampul_buku">Sampul Buku</label>
                        <input type="file" name="sampul_buku" class="form-control">
                        <p>*Format jpg atau png</p>
                    </div>
                    <div class="form-group">
                        <label for="nama_buku">Judul Buku</label>
                        <input type="text" name="nama_buku" placeholder="Masukan Nama Buku" class="form-control" autofocus-required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pengarang_buku">Nama Pengarang</label>
                        <input type="text" name="pengarang_buku" placeholder="Masukan Nama Pengarang" class="form-control" autofocus-required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="penerbit_buku">Nama Penerbit</label>
                        <input type="text" name="penerbit_buku" placeholder="Masukan Nama Penerbit" class="form-control" autofocus-required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_buku">Deskripsi</label>
                        <textarea type="text" name="deskripsi_buku" placeholder="Masukan Deskripsi" class="form-control" autofocus-required autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sinopsis_buku">Sinopsis</label>
                        <textarea type="text" name="sinopsis_buku" placeholder="Masukan Sinopsis" class="form-control" autofocus-required autocomplete="off"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah_buku">Jumlah Buku</label>
                                <input type="number" min="1" name="jumlah_buku" placeholder="Masukan Jumlah Buku" class="form-control" autofocus-required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input type="text" name="tahun_terbit" placeholder="Masukan Tahun Terbit Buku" class="form-control" autofocus-required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <option disabled selected>Pilih Kategori Buku</option>
                                    <?php
                                    while ($data = mysqli_fetch_assoc($queryKategori)) {
                                    ?>
                                        <option value="<?= $data['id_kategori']; ?>"><?= $data['kategori']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
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

<!-- Modal Import Buku -->
<div class="modal fade" id="importBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Buku</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/import_buku_proses.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="excel_buku">File Import Buku</label>
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