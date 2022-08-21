<?php
//koneksi ke database

$konek= mysqli_connect ("localhost","fisikami_tbldata", "^hmnGPD917by", "fisikami_tugasakhir");

//baca isi tabel di database (tbsuhu)
$sql= mysqli_query($konek, "SELECT*FROM monitoring WHERE id IN (SELECT MAX(id) FROM monitoring) LIMIT 1" );
$suhu = mysqli_fetch_array($sql);

$ceknama = $suhu["Nama"];
echo $ceknama ;
?>