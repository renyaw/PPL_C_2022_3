<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Operator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://unpkg.com/htmlincludejs"></script>
  </head>
  <body class="bg-light">
    <?php 
    session_start();
    require_once('db_login.php');
    ?>
    <div class="container bg-white px-3 ">
        <h3 class="mt-3 mb-3">Dashboard Operator</h3>
        <div class="row">
            <div class="col-md-6">
              <div class="card mb-3" style="max-width: 540px; background-color: #f1f1f1">
                <div class="row g-0">
                  <div class="col-md-4 mx-auto my-auto">
                    <div class="card-title mt-2">Profil</div>
                    <img src="img\bebekbulet.png" class="img-fluid rounded-start mx-auto mb-3" alt="bebek" style="width: 90%" />
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                      <p class="card-title fs-4">Bensu</p>
                      <p class="card-text">Operator</p>
                      <p class="card-text">Fakultas Sains dan Matematika</p>
                      <p class="card-text">Informatika</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 mx-auto">
                <div class="card" style="background-color: #84ffff">
                  <div class="card-body">
                    <div class="card-title">100</div>
                    <p>Mahasiswa Perwalian Aktif</p>
                  </div>
                </div>
      
                <div class="card mt-2 mb-5" style="background-color: #fdff8f">
                    <div class="card-body">
                        <div class="card-title">10</div>
                        <p>Mahasiswa Perwalian Skripsi</p>
                    </div>
                  </div>
                </div>
      
                <div class="col-md-3">
                <div class="card" style="background-color: #97ff95">
                  <div class="card-body">
                    <div class="card-title">50</div>
                    <p>Mahasiswa Perwalian PKL</p>
                  </div>
                </div>
      
                <div class="card mt-2" style="background-color: rgba(255, 115, 115, 0.74)">
                  <div class="card-body">
                    <div class="card-title">5</div>
                    <p>Mahasiswa Non-Aktif</p>
                  </div>
                </div>
              </div>
            </div>

    <div class="container">
        <div class="row">
            <div class="col-2 mt-5">
            <select name="status" id="status" onchange="showMhs(this.value)" class="form-select" aria-label="Default select example">
                <option value="3">Tampilkan Semua</option>
                <option value="1">1</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
              </select>
            </div>
            <!-- Cari -->
            <div class="col-2 mt-5 ">
            <form action="" method="GET">
              <div class="input-group mb-3">
                <input type="text" name="search" value="<?php if(isset($_GET["search"])){echo $_GET['search'];}?>" class="form-control" placeholder="">
                <button type="submit" class="btn btn-outline-secondary">Cari</button>
              </div>
            </form>
            </div>
            <!-- Selesai Cari -->
          </div>
          <div class="row text-center">
            <div class="col">
              <div id="detail_mhs">          
                <script>
                  window.onload = function(){
                    showMhs(3);
                  }
                </script>
              </div>
            </div>
          </div>
    </div>

      <br>
    <?php 
    include("footer.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="ajaxsrs9.js"></script>
  </body>
</html>