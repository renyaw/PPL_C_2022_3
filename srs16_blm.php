<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>List Skripsi</title>
    <script src="https://unpkg.com/htmlincludejs"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter";
            font-size: 22px;
        }
    </style>
</head>

<body class="bg-light">
    <?php
    session_start();
    require_once('db_login.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <include src="navdep.html"></include>
    <br />
    <div class="container p-4 bg-white">
        <h3>List Skripsi</h3>
        <hr />
        <br />
        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-outline-success" type="submit" onclick="location.href='srs16_lul.php'">Lulus</button>
            <button class="btn btn-danger" type="button">Belum Lulus</button>
        </div>
        <br />
        <div class="d-grid d-md-block">
            <button class="btn btn-outline-secondary" type="button" onclick="showTabelskripsiblm('x');">Semua</button>
            <?php
            $query = $db->query("SELECT angkatan FROM mahasiswa where nim in(SELECT max(nim) FROM mahasiswa group by angkatan) order by angkatan");
            while ($row = $query->fetch_object()) {
                echo "<button class='btn btn-outline-secondary mx-1' id='angkatan' value='$row->angkatan' onclick='showTabelskripsiblm($row->angkatan)'>" . $row->angkatan . "</button>";
            }
            ?>
        </div>
        <br />
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Dosen Penguji</th>
                        <th scope="col">Angkatan</th>
                    </tr>
                </thead>
                <tbody id="tabel_skripsiblm" class="table-group-divider">
                </tbody>
            </table>
        </div>
        <br />

    </div>
    <script src='ajax1.js'></script>
    <script>
        window.onload = function() {
            showTabelskripsiblm('x');
        }
    </script>

    <?PHP
    include('Footer.php');
    ?>
</body>

</html>