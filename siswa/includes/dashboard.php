<!-- Banner -->
<div class="container-fluid d-flex align-items-center" style="height: 80vh; width:auto;
            background-repeat:no-repeat;
            background-image: url(../logo/interface.png)">
    <div class="container text-center text-white">
        <h3>Wellcome Back, <?= $_SESSION['nama']; ?></h3>
        <h5>Sistem Informasi Perpustakaan SMA Negeri 4 Purwokerto</h5>
        <div class="col-md-8 offset-md-2">
            <form method="GET" action="buku.php">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Cari buku apa?" name="keyword" autocomplete="off">
                    <button type="submit" class="btn btn-outline-light">Telusuri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- highlighted kategori -->
<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Kategori Populer</h3>
        <div class="row mt-5">
            <!-- highlighted kategori mata pelajaran -->
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center" style="height: 250px; background-image: url(../logo/mapel_sm.png)" </div>
                    <h4 class="text-white">
                        <a style="text-decoration: none; color: white;" href="buku.php?kategori=Mata Pelajaran">Mata Pelajaran</a>
                    </h4>
                </div>
            </div>
            <!-- highlighted kategori novel -->
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center" style="height: 250px; background-image: url(../logo/novel_sm.png)" </div>
                    <h4 class="text-white">
                        <a style="text-decoration: none; color: white;" href="buku.php?kategori=Novel">Novel</a>
                    </h4>
                </div>
            </div>
            <!-- highlighted kategori majalah -->
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center" style="height: 250px; background-image: url(../logo/magazine_sm.png)" </div>
                    <h4 class="text-white">
                        <a style="text-decoration: none; color: white;" href="buku.php?kategori=Majalah">Majalah</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- about us -->
<div class="container-fluid bg-secondary py-5">
    <div class="container text-center text-white">
        <h3>Tentang Kami</h3>
        <p class="fs-5 mt-3">
            Perpustakaan SMA Negeri 4 Purwokerto memiliki nama Perpustakaan Widya Utama </br>
            Nama Widya Utama diambil dari kata Widya yang berarti Pengetahuan dan Utama yang berarti Keutamaan </br>
            Perpustakaan Widya Utama diharapkan memiliki fungsi penelitian, rekreasi, informasi, juga yang utama adalah fungsi pendidikan </br>
            Sejalan dengan itu perpustakaan sekolah memiliki peran yang sangat penting dalam mewujudkan visi dan misi SMA Negeri 4 Purwokerto yaitu </br>
            Unggul Prestasi, Luhur Budi Pekerti dan Handal Kreativitas
        </p>
    </div>
</div>

<!-- highlighted buku -->
<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Buku</h3>
        <div class="row mt-5">
            <?php while ($data = mysqli_fetch_array($query)) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div style="height: 400px;">
                            <img src="../sampul/<?= $data['sampul_buku']; ?>" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?= $data['nama_buku']; ?></h4>
                            <p class="card-text"><?= $data['pengarang']; ?></p>
                            <a class="btn btn-secondary" href="detail-buku.php?nama=<?= $data['nama_buku']; ?>">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a href="buku.php" class="btn btn-outline-secondary mt-3">Lihat Lainnya</a>
    </div>
</div>