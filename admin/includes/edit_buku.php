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
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <h2>Edit Data Buku</h2>
    <hr>

    <a href="../admin/data-buku.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <br>

    <div class="clear-fix card mx-auto mt-4 mb-4 col-sm-10">
        <?php
        //mengambil data buku yang akan diubah
        $buku = $conn->query("SELECT * FROM buku LEFT JOIN kategori ON kategori.id_kategori = buku.id_kategori WHERE id_buku = '$_GET[id]'");
        $data = $buku->fetch_assoc();

        //mengambil data kategori yang akan diubah
        $sqlKategori = "SELECT * FROM kategori WHERE id_kategori!='$data[id_kategori]'";
        $queryKategori = mysqli_query($conn, $sqlKategori);
        ?>

        <form action="../proses/edit_buku_proses.php" method="POST" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id_buku'] ?>">
            <div class="form-group">
                <label>Sampul Buku</label> <br>
                <img src="../sampul/<?= $data['sampul_buku']; ?>" style="width: 120px;"> <br>
                <input type="file" name="sampul_buku" class="mt-2">
            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="nama_buku" class="form-control" value="<?= $data['nama_buku'] ?>" placeholder="Masukan Nama Buku" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Nama Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="<?= $data['pengarang'] ?>" placeholder="Masukan Nama Pengarang" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Nama Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="<?= $data['penerbit'] ?>" placeholder="Masukan Nama Penerbit" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea type="text" name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" required autocomplete="off"><?= $data['deskripsi'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Sinopsis</label>
                <textarea type="text" name="sinopsis" class="form-control" placeholder="Masukan Sinopsis" required autocomplete="off"><?= $data['sinopsis'] ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_buku">Jumlah Buku</label>
                        <input type="number" min="1" name="jumlah_buku" placeholder="Masukan Jumlah Buku" class="form-control" value="<?= $data['jumlah'] ?>" required autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="text" name="tahun_terbit" placeholder="Masukan Tahun Terbit Buku" class="form-control" value="<?= $data['tahun_terbit'] ?>" required autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select name="id_kategori" class="form-control">
                            <option disabled>Pilih Kategori Buku</option>
                            <option selected value="<?= $data['id_kategori']; ?>"><?= $data['kategori']; ?></option>
                            <?php
                            while ($kategori = mysqli_fetch_assoc($queryKategori)) {
                            ?>
                                <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['kategori']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-success float-right mb-3">Simpan</button>
        </form>
    </div>
</div>