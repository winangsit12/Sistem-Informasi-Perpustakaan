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
            <li class="breadcrumb-item active" aria-current="page">Kategori</li>
        </ol>
    </nav>
    <h2>Data Kategori Buku</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <!-- Button Trigger Modal Tambah Kategori-->
    <button type="button" class="btn btn-outline-info btn-sm float-right" data-bs-toggle="modal" data-bs-target="#tambahKategori">
        + &nbsp; Tambah Data
    </button>
    <a href="data-kategori.php" class="btn btn-light btn-sm float-right mr-3">
        &#x21BA;
    </a>
    <div class="float-right">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Data Kategori" autocomplete="off" required="required">
        </form>
    </div>

    <div class="clearfix"></div>

    <table class="table table-sm mt-3">
        <thead>
            <tr>
                <th>No. </th>
                <th>Kategori Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($kategori = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $kategori['kategori']; ?></td>
                    <td>
                        <div class="d-inline">
                            <a href="?p=edit-kategori&id=<?= $kategori['id_kategori']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                            <a href="?p=hapus-kategori&id=<?= $kategori['id_kategori']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-outline-danger btn-sm">Hapus</a>
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

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kategori Buku</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="../proses/tambah_kategori_proses.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kategori">Kategori Buku</label>
                        <input type="text" name="kategori" placeholder="Masukan Kategori Buku" class="form-control" autofocus-required autocomplete="off">
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