<?php
include ('Connect.php');
//Koneksi database

//baca data yang dikirim dari Arduino
$identitas=$_POST['nama'];
$nilaisuhu=$_POST['suhu'];
if($nilaisuhu >35 && $nilaisuhu <=37) {
    $pintu= 'Terbuka';
}
else {
    $pintu='Tertutup';
}

//simpan ke tabel tbukursuhu

//auto increment =1
mysqli_query($conn,"ALTER TABLE monitoring AUTO_INCREMENT=1");
//simpan data sensor
$query = mysqli_query($conn,"INSERT INTO `monitoring`(`Nama`,`besarsuhu`,`status`) VALUES ('$identitas','$nilaisuhu','$pintu')");
      
       
?>