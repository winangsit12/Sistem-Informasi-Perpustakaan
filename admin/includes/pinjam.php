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
            <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
        </ol>
    </nav>
    <h2>Data Peminjaman</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <a href="includes/laporan_pinjam_pdf.php" target="_blank" class="btn btn-outline-danger btn-sm float-left ml-3">Cetak PDF</a>
    <a href="includes/laporan_pinjam_excel.php" target="_blank" class="btn btn-outline-success btn-sm float-left ml-3">Cetak Excel</a>

    <a href="data-pinjam.php" class="btn btn-light btn-sm float-right mr-3">
        &#x21BA;
    </a>
    <div class="float-right">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Data Peminjaman" autocomplete="off" required="required">
        </form>
    </div>

    <div class="clearfix"></div>

    <table class="table table-sm mt-3">
        <thead>
            <tr>
                <th>No. </th>
                <th>Judul Buku</th>
                <th>Nama Peminjam</th>
                <th>Nomor Induk Siswa</th>
                <th>Kelas</th>
                <th>Tanggal Peminjaman</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($pinjam = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pinjam['nama_buku']; ?></td>
                    <td><?= $pinjam['nama']; ?></td>
                    <td><?= $pinjam['username']; ?></td>
                    <td><?= $pinjam['kelas']; ?></td>
                    <td><?= date('d-m-Y', strtotime($pinjam['tanggal_pinjam'])); ?></td>
                    <td>
                        <div class="d-inline">
                            <a href="?p=izin-kembali&id=<?= $pinjam['id_pinjam']; ?>" class="btn btn-outline-primary btn-sm" id="kembali">Kembalikan Buku</a>
                            <a href="?p=tidak-kembali&id=<?= $pinjam['id_pinjam']; ?>" class="btn btn-outline-danger btn-sm">Buku Tidak Kembali</a>
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