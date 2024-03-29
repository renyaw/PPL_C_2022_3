<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Upload IRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter";
            font-size: 22px;
        }
    </style>
    <script src="https://unpkg.com/htmlincludejs"></script>
</head>

<body class="bg-light">
    <?php
    session_start();
    require_once('db_login.php');
    $noinduk = $_SESSION['noinduk'];
    $query2 = $db->query("SELECT fotoprofile FROM mahasiswa where nim ='$noinduk'");
    $data2 = mysqli_fetch_assoc($query2);

    $query3 = $db->query("SELECT semester_aktif as smt from irs where semester_aktif in(select max(semester_aktif) from irs WHERE nim=$noinduk group by nim) and nim=$noinduk");
    $data3 = mysqli_fetch_assoc($query3);

    $smt = $data3['smt'];

    if (isset($_POST["submit"])) {
        //fileirs
        $ekstensi_diperbolehkan    = array('pdf');
        $namafile = $_FILES['file']['name'];
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        //untuk data lainnya
        $smtinput = test_input($_POST['semester']);
        $sks = test_input($_POST["sks"]);

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'fileirs/' . $namafile);
                $result = $db->query("INSERT INTO irstemp values(NULL,'$smtinput','0','$sks','$namafile','$noinduk')");
                if ($result) {
                    header("location:srs3.php?pesan=sukses");
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

    <include src="navbar.php"></include>
    <div class="container bg-white p-5">
        <?php
        if (isset($_GET['pesan'])) {
            //salah akun/password
            if ($_GET['pesan'] == "gagal") {
                echo "<div class='alert alert-danger text-center'>Data gagal disimpan</div>";
            } else {
                echo "<div class='alert alert-success text-center'>Data berhasil disimpan</div>";
            }
        }
        ?>
        <h2 class="fw-bold">Entry IRS</h2>
        <hr />
        <div class="card bg-light px-5 pb-5 pt-4 mt-5">
            <h2 class="fw-bold">Profile</h2>
            <hr />
            <div class="row justify-content-between">
                <div class="col-3">
                    <div class="row align-self-center">
                        <div class="card col bg-transparent border-0 mx-auto">
                            <img src="<?php echo "fotoprofile/" . $data2['fotoprofile'];  ?>" style="border-radius:5%;" class="img-fluid" />
                        </div>
                    </div>

                    <div class="card text-center mt-3 mx-auto bg-success text-white" style="width: 14vh; max-width: 100px">
                        <?php
                        $noinduk = $_SESSION['noinduk'];
                        $query = $db->query("SELECT status FROM khs where nim ='$noinduk'");
                        $data = mysqli_fetch_assoc($query);
                        echo $data['status']
                        ?>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row mt-4">
                        <div class="col-6">
                            <h3 class="fw-bold">Nama</h3>
                            <?php
                            $noinduk = $_SESSION['noinduk'];
                            $query = $db->query("SELECT nama FROM mahasiswa where nim ='$noinduk'");
                            $data = mysqli_fetch_assoc($query);
                            echo "<p>" . $data['nama'] . "</p>"
                            ?>
                        </div>
                        <div class="col-6">
                            <h3 class="fw-bold">NIM</h3>
                            <?php
                            $noinduk = $_SESSION['noinduk'];
                            $query = $db->query("SELECT nim FROM mahasiswa where nim ='$noinduk'");
                            $data = mysqli_fetch_assoc($query);
                            echo "<p>" . $data['nim'] . "</p>"
                            ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <h3 class="fw-bold">Angkatan</h3>
                            <?php
                            $noinduk = $_SESSION['noinduk'];
                            $query = $db->query("SELECT angkatan FROM mahasiswa where nim ='$noinduk'");
                            $data = mysqli_fetch_assoc($query);
                            echo "<p>" . $data['angkatan'] . "</p>"
                            ?>
                        </div>
                        <div class="col-6">
                            <h3 class="fw-bold">Dosen Wali</h3>
                            <?php
                            $noinduk = $_SESSION['noinduk'];
                            $query = $db->query("SELECT dosen.nama FROM dosen inner join mahasiswa where nim ='$noinduk' and mahasiswa.kode_wali=dosen.kode_wali");
                            $data = mysqli_fetch_assoc($query);
                            echo "<p>" . $data['nama'] . "</p>"
                            ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <h3 class="fw-bold">Jumlah SKS</h3>
                            <?php
                            $noinduk = $_SESSION['noinduk'];
                            $query = $db->query("SELECT max(sks_kumulatif) as sks_kumulatif FROM khs where nim ='$noinduk'");
                            $data = mysqli_fetch_assoc($query);
                            echo "<p>" . $data['sks_kumulatif'] . "</p>"
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" onsubmit="" name="form" enctype="multipart/form-data">
            <div class="card mt-5 p-5 bg-light">
                <div class="row">
                    <h3 class="fw-bold">Semester:</h3>
                </div>
                <div class="row mx-2">
                    <input type="text" name="semester" id="semester" class="border rounded-2" style="background-color: rgb(178, 178, 178)" value="<?php if (empty($smt)) {
                                                                                                                                                        echo '1';
                                                                                                                                                    } else {
                                                                                                                                                        echo $smt + 1;
                                                                                                                                                    } ?>" />
                </div>
                <div class="row mt-4">
                    <h3 class="fw-bold">SKS Semester</h3>
                </div>
                <div class="row mx-2">
                    <input type="text" name="sks" id="sks" class="border rounded-2" style="background-color: rgb(178, 178, 178)" placeholder="Masukan jumlah SKS yang diambil semester ini..." />
                </div>
                <div class="row mt-4">
                    <h3 class="fw-bold">Upload Scan IRS</h3>
                </div>
                <div class="row">
                    <input type="file" name="file" id="file" class="ms-2" />
                </div>
                <div class="row align-self-end">
                    <div class="col-2 me-1">
                        <button type="submit" name="submit" class="rounded btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <?PHP
    include('Footer.php');
    ?>
</body>

</html>