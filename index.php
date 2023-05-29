<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Perpustakaan SMA 4 Purwokerto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="background-image: url(logo/bg-login.jpg);
            background-size:cover;">

    <!-- pesan kesalahan -->
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "gagal") {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <center>Username/NIS dan Password tidak valid !</center>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
    }
    ?>
    <div class="card text-bg-light col-sm-4 d-flex align-items-right" style="
        border-radius: 8px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 435px;
        margin: 8rem auto 8rem auto;
        width: 340px;">
        <div class="card-header" style="font-family: Raleway Thin, sans-serif;
        letter-spacing: 1px;
        padding-bottom: 23px;
        padding-top: 13px;
        text-align: center;">
            <img src="logo/logoan.png" style="height: 100px; width: 100px;"> </br>
            Sistem Informasi Perpustakaan
        </div>
        <div class="card-body">
            <form method="POST" action="proses/login_proses.php" autocomplete="off">
                <div class="form-group">
                    <label for="username" style="font-family: Raleway, sans-serif; font-size: 11pt;">Username/NIS</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukan Username/NIS" required="required">
                </div>
                <div class="form-group">
                    <label for="password" style="font-family: Raleway, sans-serif; font-size: 11pt;">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukan Password" required="required">
                </div>
                <div class="form-group">
                    <label for="id_level"> </label>
                    <select name="id_level" class="form-control text-center">
                        <option disabled selected>-- Login Sebagai --</option>
                        <option value="2">Siswa</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary col-sm-12 mt-3">Masuk</button>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>