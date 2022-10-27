<?php require_once('db_connect.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://unpkg.com/htmlincludejs"></script>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <include src="navbar.php"></include>
    <br>
    <div class="container">
        <h3>Progress Skripsi</h3>
        <hr>
        <div class="alert alert-warning" role="alert">
            Anda belum mengambil/memasukkan data skripsi!
        </div>
        <br>
        <div class="p-3 mb-2 bg-light text-dark">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama">
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim">
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul">
            </div>
            <div class="mb-3">
                <label for="doswal" class="form-label">Dosen Wali</label>
                <select class="form-select" id="dosen" name="dosen">
                  <option>-- Pilih Dosen Wali --</option>
                    <?php
                      $result = $db->query('select * from dosen');
                      while ($data = $result->fetch_object()):
                    ?>
                      <option value="<?php echo $data->id ?>"><?php echo $data->nama ?></option>
                    <?php 
                      endwhile 
                    ?>
                </select>
            </div>
            <br>
            <div class="d-grid d-md-flex justify-content-md-end">
              <a href="srs6_ong.html"><button class="btn btn-primary" type="button">Submit</button></a>
            </div>
        </div>
        <br>
    </div>
    <div class="bg-white">
      <br>
      <br>
    </div>
    <?PHP
    include('Footer.php');
    ?>
  </body>