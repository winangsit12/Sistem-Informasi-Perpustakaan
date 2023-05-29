<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
    <h2>Detail Admin</h2>
    <hr>

    <a href="../admin/data-admin.php" class="btn btn-outline-secondary btn-sm float-left">&larr; Kembali</a>
    <br>

    <?php
    //mengambil data buku
    $admin = $conn->query("SELECT * FROM users WHERE id_user = '$_GET[id]'");
    $data = $admin->fetch_assoc();
    ?>

    <div class="clear-fix card mx-auto mt-4 mb-4 col-sm-10">
        <div class="card-header">
            <b>Detail Admin <?= $data['nama'] ?></b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="../foto/<?= $data['foto']; ?>" style="width: 180px;">
                    <p>Foto Admin</p>
                </div>
                <div class="col-md-6 mt-2">
                    <p>Nama Admin : <?= $data['nama'] ?></p>
                    <p>Username : <?= $data['username'] ?></p>
                    <p>Jenis Kelamin : <?= $data['jenis_kelamin'] ?></p>
                    <p>Sebagai : <?= $data['level'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>