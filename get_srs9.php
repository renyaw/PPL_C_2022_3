<?php
// include our login information
//menginisialilasi session lalu akan diteruskan ke get dan post
require_once "db_login.php"; // memanggil halaman
$id = $_GET['id'];
//'max(khs.smt) dan group by nim' untuk mengambil smt tertinggi dari nim yang sama
//'smt in (SELECT max(smt) FROM khs group by smt)' untuk mengambil apasaja data smt pada tabel khs, digunakan group by karena akan diambil max dari data smt yang duplikat
//'where smt in ()' supaya smt yang diambil hanya menggunakan smt yang sudah dilakukan pada query internal
$query = "SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.email, max(khs.smt) as smt, khs.status, khs.ip_kumulatif as ipk FROM mahasiswa,khs where mahasiswa.nim=khs.nim AND smt in (SELECT max(smt) FROM khs group by smt) GROUP by nim  order by smt desc LIMIT $id;";
#SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.email, max(khs.smt) as smt, khs.status FROM mahasiswa,khs where mahasiswa.nim=khs.nim  GROUP by nim  order by smt desc 
//default
$query2 =
    "SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.email, max(khs.smt) as smt, khs.status , khs.ip_kumulatif as ipk FROM mahasiswa,khs where mahasiswa.nim=khs.nim AND smt in (SELECT max(smt) FROM khs group by smt) GROUP by nim order by smt desc";


//sort
$sortR = $db->query($query);
if (!$sortR) {
    die("Could not the query the database: <br />" . $db->error . "<br>Query: " . $query);
}
//default
$defaultR = $db->query($query2);
if (!$defaultR) {
    die("Could not the query the database: <br />" . $db->error . "<br>Query: " . $query);
}
echo '
<table class="table table-hover text-center table-bordered mt-4">
<thead>
  <tr>
    <th scope="col">NIM</th>
    <th scope="col">Nama Mahasiswa</th>
    <th scope="col">Email</th>
    <th scope="col">Semester</th>
    <th scope="col">Status</th>
    <th scope="col">IP Kumulatif</th>
    <th scope="col">Action</th>
  </tr>
</thead>';
// fetch and display the results

if ($id == "3") {
    $result = $defaultR;
} else {
    $result = $sortR;
}


$i = 1;
while ($row = $result->fetch_object()) {
    // fetch_object-> mengembalikan baris saat ini dari kumpulan hasil sebagai objek atau keluarasnfungsi mengembalikan baris saat ini
    echo "<tr>";
    echo "<td>" . $row->nim . "</td>";
    echo "<td>" . $row->nama . "</td>";
    echo "<td>" . $row->email . "</td>";
    echo "<td>" . $row->smt . "</td>";
    echo "<td>" . $row->status . "</td>";
    echo "<td>" . $row->ipk . "</td>";
    echo '<td><a class="btn btn-warning btn-sm" href="edit_srs9.php?id=' . $row->nim . '">Edit</a>&nbsp;&nbsp;
            </td>';
    echo "</tr>";
    $i++;
}


echo "</table>";
echo "<br />";
$result->free();
$db->close();
