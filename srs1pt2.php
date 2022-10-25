<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Data Pribadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://unpkg.com/htmlincludejs"></script>
  </head>
  <body>
    <div class="container px-5 pt-4 pb-5">
      <h2>Data Mahasiswa</h2>
      <div class="alert alert-success pb-1 pt-2" role="alert">
          <h5>Info : Data berhasil disimpan.</h5>
          <p>Pastikan daya yang Anda Masukkan benar.</p>
        </div>
      <div class="row">
        <div class="col-4 mt-3">
          <div class="image overflow-hidden">
              <img class="" src="img\Bebek.png" alt="" width="250" />
          </div>
        </div>
        <div class="col-8">
        <form>
          
        <div class="mt-1 mb-3">
          <label for="staticEmail" class=" col-form-label fw-semibold">NIM Mahasiswa</label>
            <input type="text" readonly class="form-control-plaintext  " id="staticEmail" value="(ambil dari db)">
        </div>
        <div class="mb-3">
          <label for="staticEmail" class=" col-form-label fw-semibold">Nama Mahasiswa</label>
            <input type="text" readonly class="form-control-plaintext " id="staticEmail" value="(ambil dari db)">
        </div>
        <div class="row mb-3">
          <label for="staticEmail" class="col-sm-3 col-form-label fw-semibold">Angkatan : </label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="(Ambil dari db)">
          </div>
        </div>
        <div class=" row mb-3">
          <label for="staticEmail" class="col-sm-3 col-form-label fw-semibold">Status : </label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="(Ambil dari db)">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-3 col-form-label fw-semibold">Kode Wali : </label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="(Ambil dari db)">
          </div>
        </div>
        
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary mt-4 ">Submit</button>
        </div>
        
        </form>

        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>