<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://unpkg.com/htmlincludejs"></script>
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter";
            font-size: 22px;
        }
    </style>
</head>

<body class="bg-light">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <include src="navbar.php"></include>
    <?php
    require_once('db_login.php');
    session_start();
    $noinduk = $_SESSION["noinduk"];
    $query = $db->query("SELECT * from mahasiswa where nim='$noinduk'");
    $data = mysqli_fetch_assoc($query);


    if (isset($_POST["submit"])) {
        $ekstensi_diperbolehkan    = array('pdf');
        $namafile = $_FILES['file']['name'];
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $judul = test_input($_POST['judul']);

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'fileskrip/' . $namafile);
                $result = $db->query(
                    "INSERT INTO skripsitemp values (NULL,'$noinduk', '$judul','belum lulus', NULL, NULL, '$namafile')"
                );
                if ($result) {
                    header("location:srs6_belum.php?pesan=sukses");
                } else {
                    echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            } else {
                echo 'UKURAN FILE TERLALU BESAR';
            }
        } else {
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }

    ?>
    <br>
    <div class="container p-4 bg-white">
        <?php
        if (isset($_GET['pesan'])) {
            //salah akun/password
            if ($_GET['pesan'] == "gagal") {
                echo "<div class='alert alert-danger text-center'>Data gagal disimpan</div>";
            } else {
                echo "<div class='alert alert-success text-center'>Data berhasil disimpan</div>";
            }
        }

        if (isset($_GET['status'])) {
            if ($_GET['status'] == "belum") {
                echo "<div class='alert alert-success text-center alert-dismissible fade show' role='alert'>Silakan Memasukkan data skripsi!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
            }
            if ($_GET['status'] == "sudah") {
                echo "<div class='alert alert-success text-center alert-dismissible fade show' role='alert'>Anda sedang mengerjakan skripsi. Silahkan update progress skripsi secara berkala.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
            }
        }
        ?>
        <h3>Entry Skripsi</h3>
        <hr>
        <br>
        <div class="p-3 mb-2 bg-light text-dark">
            <form method="POST" name="form" autocomplete="on" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" value="<?php echo "&nbsp;" .
                                                                                    $data["nama"]; ?>" disabled />
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" value="<?php echo "&nbsp;" .
                                                                                $data["nim"]; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload File Skripsi</label>
                    <input class="form-control" type="file" id="formFile" name="file" />
                </div>
                <br>
                <div class="d-grid d-md-flex justify-content-md-end">
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-warning ms-2 shadow" onclick="location.href='srs10.php'">Kembali</button>
                </div>
            </form>
        </div>
        <br>
    </div>

    <?PHP
    include('Footer.php');
    ?>
</body>