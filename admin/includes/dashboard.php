<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    <h2 class="mt-1">Hello, <?= $_SESSION['nama']; ?></h2>
    <div class="row text-center">
        <!-- Membuat card data buku -->
        <div class="col-md-4 mt-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">

                    <?php
                    $q = $conn->query("SELECT COUNT(*) AS jmlBuku FROM buku");
                    $buku = $q->fetch_array();
                    ?>

                    <h5 class="card-title">Data Buku</h5>
                    <p class="card-text">Jumlah buku saat ini</p>
                    <h4><?= $buku['jmlBuku']; ?></h4>
                    <a style="text-decoration: none; color: grey;" href="../admin/data-buku.php" class="card-link">Lihat data buku</a>
                </div>
            </div>
        </div>

        <!-- Membuat card data permintaan -->
        <div class="col-md-4 mt-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">

                    <?php
                    $q = $conn->query("SELECT COUNT(*) AS jmlMinta FROM peminjaman WHERE id_level = 1");
                    $minta = $q->fetch_array();
                    ?>

                    <h5 class="card-title">Data Permintaan</h5>
                    <p class="card-text">Jumlah permintaan pinjam saat ini</p>
                    <h4><?= $minta['jmlMinta']; ?></h4>
                    <a style="text-decoration: none; color: grey;" href="../admin/data-minta.php" class="card-link">Lihat data permintaan</a>
                </div>
            </div>
        </div>

        <!-- Membuat card data pengembalian -->
        <div class="col-md-4 mt-3">
            <div class=" card" style="width: 18rem;">
                <div class="card-body">

                    <?php
                    $q = $conn->query("SELECT COUNT(*) AS jmlPengembalian FROM pengembalian");
                    $pengembalian = $q->fetch_array();
                    ?>

                    <h5 class="card-title">Data Pengembalian</h5>
                    <p class="card-text">Jumlah transaksi keseluruhan</p>
                    <h4><?= $pengembalian['jmlPengembalian']; ?></h4>
                    <a style="text-decoration: none; color: grey;" href="../admin/data-kembali.php" class="card-link">Lihat data pengmbalian buku</a>
                </div>
            </div>
        </div>

        <!-- Membuat card data siswa -->
        <div class="col-md-4 mt-5">
            <div class="card" style="width: 18rem;">
                <div class="card-body">

                    <?php
                    $q = $conn->query("SELECT COUNT(*) AS jmlSiswa FROM users WHERE id_level = 2");
                    $siswa = $q->fetch_array();
                    ?>

                    <h5 class="card-title">Data Siswa</h5>
                    <p class="card-text">Jumlah siswa terdaftar saat ini</p>
                    <h4><?= $siswa['jmlSiswa']; ?></h4>
                    <a style="text-decoration: none; color: grey;" href="../admin/data-siswa.php" class="card-link">Lihat data siswa</a>
                </div>
            </div>
        </div>

        <!-- Membuat card data siswa -->
        <div class="col-md-4  mt-5"">
            <div class=" card" style="width: 18rem;">
            <div class="card-body">

                <?php
                $q = $conn->query("SELECT COUNT(*) AS jmlPeminjaman FROM peminjaman WHERE id_level = 2");
                $peminjaman = $q->fetch_array();
                ?>

                <h5 class="card-title">Data Peminjaman</h5>
                <p class="card-text">Jumlah buku dipinjam saat ini</p>
                <h4><?= $peminjaman['jmlPeminjaman']; ?></h4>
                <a style="text-decoration: none; color: grey;" href="../admin/data-pinjam.php" class="card-link">Lihat data peminjaman buku</a>
            </div>
        </div>
    </div>

    <!-- Membuat card data hilang -->
    <div class="col-md-4 mt-5">
        <div class=" card" style="width: 18rem;">
            <div class="card-body">

                <?php
                $q = $conn->query("SELECT COUNT(*) AS jmlHilang FROM hilang");
                $hilang = $q->fetch_array();
                ?>

                <h5 class="card-title">Buku Tidak Kembali</h5>
                <p class="card-text">Jumlah buku tidak kembali</p>
                <h4><?= $hilang['jmlHilang']; ?></h4>
                <a style="text-decoration: none; color: grey;" href="../admin/data-hilang.php" class="card-link">Lihat data buku tidak kembali</a>
            </div>
        </div>
    </div>
</div>