<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Buku</li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
    <h2>Detail Buku</h2>
    <hr>

    <a href="../admin/data-buku.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <br>

    <?php
    //mengambil data buku
    $buku = $conn->query("SELECT * FROM buku LEFT JOIN kategori ON kategori.id_kategori = buku.id_kategori WHERE id_buku = '$_GET[id]'");
    $data = $buku->fetch_assoc();
    ?>

    <div class="clear-fix card mx-auto mt-4 mb-4 col-sm-10">
        <div class="card-header">
            <b>Detail Buku <?= $data['nama_buku'] ?></b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mt-4 text-center">
                    <img src="../sampul/<?= $data['sampul_buku']; ?>" style="width: 180px;">
                    <p>Sampul Buku</p>
                </div>
                <div class="col-md-6 mt-4">
                    <p>Judul Buku : <?= $data['nama_buku'] ?></p>
                    <p>Nama Pengarang : <?= $data['pengarang'] ?></p>
                    <p>Nama Penerbit : <?= $data['penerbit'] ?></p>
                    <p>Tahun Terbit : <?= $data['tahun_terbit'] ?></p>
                    <p>Kategori : <?= $data['kategori'] ?></p>
                    <p>Deskripsi : <br> <?= $data['deskripsi'] ?></p>
                    <p>Sinopsis : <br> <?= $data['sinopsis'] ?></p>
                    <p>Jumlah Buku : <?= $data['jumlah'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>