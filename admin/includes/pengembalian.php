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
            <li class="breadcrumb-item active" aria-current="page">Pengembalian</li>
        </ol>
    </nav>
    <h2>Data Pengembalian</h2>
    <hr>

    <a href="index.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <!-- Button Trigger Modal Laporan Excel-->
    <button type="button" class="btn btn-outline-danger btn-sm float-left ml-3" data-bs-toggle="modal" data-bs-target="#laporanKembaliPdf">
        Cetak Pdf
    </button>
    <!-- Button Trigger Modal Laporan Excel-->
    <button type="button" class="btn btn-outline-success btn-sm float-left ml-3" data-bs-toggle="modal" data-bs-target="#laporanKembaliExcel">
        Cetak Excel
    </button>

    <a href="data-kembali.php" class="btn btn-light btn-sm float-right mr-3">
        &#x21BA;
    </a>
    <div class="float-right">
        <form method="GET" action="">
            <input type="text" name="cari" class="form-control-sm" placeholder="Cari Data Pengembalian" autocomplete="off" required="required">
        </form>
    </div>

    <div class="clearfix"></div>

    <table class="table table-sm mt-3">
        <thead>
            <tr>
                <th>No. </th>
                <th>Judul Buku</th>
                <th>Nama Peminjam</th>
                <th>NIS</th>
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
                    <td><?= $kembali['nama']; ?></td>
                    <td><?= $kembali['username']; ?></td>
                    <td><?= date('d-m-Y', strtotime($kembali['tanggal_pinjam'])); ?></td>
                    <td><?= date('d-m-Y', strtotime($kembali['tanggal_kembali'])); ?></td>
                    <td><?= $kembali['ketepatan_waktu']; ?></td>
                    <td><?= $kembali['keadaan_buku']; ?></td>
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

<!-- Modal Laporan Excel-->
<div class="modal fade" id="laporanKembaliExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Pengembalian</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="includes/laporan_kembali_excel.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-control">
                            <option disabled selected value="0">Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Febuari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" class="form-control">
                            <option disabled selected value="0">Pilih Tahun</option>
                            <?php
                            $query = "SELECT YEAR(tanggal_kembali) AS tahun FROM pengembalian GROUP BY YEAR(tanggal_kembali)";
                            $queryTahun = mysqli_query($conn, $query);
                            while ($data = mysqli_fetch_assoc($queryTahun)) {
                            ?>
                                <option value="<?= $data['tahun']; ?>"><?= $data['tahun']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-success">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Laporan Pdf-->
<div class="modal fade" id="laporanKembaliPdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Pengembalian</h1>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="includes/laporan_kembali_pdf.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-control">
                            <option disabled selected>Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Febuari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" class="form-control">
                            <option disabled selected>Pilih Tahun</option>
                            <?php
                            $query = "SELECT YEAR(tanggal_kembali) AS tahun FROM pengembalian GROUP BY YEAR(tanggal_kembali)";
                            $queryTahun = mysqli_query($conn, $query);
                            while ($data = mysqli_fetch_assoc($queryTahun)) {
                            ?>
                                <option value="<?= $data['tahun']; ?>"><?= $data['tahun']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-success" target="_blank">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>