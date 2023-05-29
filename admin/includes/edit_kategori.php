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
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <h2>Edit Data Kategori Buku</h2>
    <hr>

    <a href="../admin/data-kategori.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <br>

    <div class="clear-fix card mx-auto mt-4 mb-4 col-sm-10">
        <?php
        //mengambil data kategori yang akan diubah
        $kategori = $conn->query("SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'");
        $data = $kategori->fetch_assoc();
        ?>

        <form action="../proses/edit_kategori_proses.php" method="POST" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id_kategori'] ?>">
            <div class="form-group">
                <label>Kategori Buku</label>
                <input type="text" name="kategori" class="form-control" value="<?= $data['kategori'] ?>" placeholder="Masukan Kategori Buku" required>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-success float-right mb-3">Simpan</button>
        </form>
    </div>
</div>