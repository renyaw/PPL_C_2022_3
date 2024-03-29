<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
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
        $progress =  test_input($_POST['progress']);
        $ekstensi_diperbolehkan    = array('pdf');
        $namafile = $_FILES['file']['name'];
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'filepkl/' . $namafile);
                $result = $db->query(
                    "INSERT INTO pkltemp values (NULL,'$noinduk','$progress', '$tanggal', NULL, '0', '$namafile')"
                );
                if ($result) {
                    header("location:srs10.php?pesan=suksesupload");
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
    <div class="container p-4 bg-white">
        <h3>Progress PKL</h3>
        <hr>
        <div class="alert alert-success" role="alert">Anda sedang melakukan PKL. Silahkan update progress PKL secara berkala.</div>
        <br />
        <div class="p-3 mb-2 bg-light text-dark">
            <form method="POST" name="form" autocomplete="on" enctype="multipart/form-data">
                <div class="mb-3 form-group">
                    <label for="progress" class="form-label">Progress ke-</label>
                    <input type="text" class="form-control" id="progress" placeholder="Progres Ke-" name="progress" />
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Upload Progress PKL</label>
                    <input class="form-control" type="file" id="file" name="file" />
                </div>
                <br />
                <div class="d-grid d-md-flex justify-content-md-end">
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-warning ms-2 shadow" onclick="location.href='srs10.php'">Kembali</button>
                </div>
            </form>
            <br />
        </div>

        <?PHP
        include('Footer.php');
        ?>
</body>

</html>