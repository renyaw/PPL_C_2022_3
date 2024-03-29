<?php include 'db_login.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Tutorial Pagination - Malasngoding.com</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <center>
            <h2>Membuat Pagination PHP, MySQLI dan Boostrap 4</h2>
        </center>
        <br>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>nim</th>
                    <th>tanggal_mulai</th>
                    <th>nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $batas = 10;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                // $data = mysqli_query($koneksi,"select * from pkl");
                $data = $db->query("select * from pkl");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);

                $data_pkl = mysqli_query($db, "select mahasiswa.nama, pkl.nim, pkl.tanggal_mulai, pkl.nilai from pkl, mahasiswa where mahasiswa.nim=pkl.nim limit $halaman_awal, $batas");
                $nomor = $halaman_awal + 1;
                while ($d = mysqli_fetch_array($data_pkl)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $d['nama']; ?></td>
                        <td><?php echo $d['nim']; ?></td>
                        <td><?php echo $d['tanggal_mulai']; ?></td>
                        <td><?php echo $d['nilai']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                                                echo "href='?halaman=$previous'";
                                            } ?>>Previous</a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                echo "href='?halaman=$next'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>