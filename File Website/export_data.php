<?php
include ('Connect.php');
include "../../config/function.php";
date_default_timezone_set('Asia/Jakarta');
$Tanggal = date("Y-m-d");
$Waktu = date("H:i:s");
//header("Content-type: application/octet-stream");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=Data Monitoring $Tanggal.csv");

$fp = fopen('php://output', 'w');
$result = mysqli_query($conn, "SELECT * FROM monitoring");
// $list = mysqli_fetch_array($result);

fputcsv($fp, array('ID','Nama','Suhu', 'Status', 'Tanggal', 'Waktu'));
while($fields = mysqli_fetch_array($result)) {
    fputcsv($fp, array($fields['Id'],$fields['Nama'],floatval($fields['besarsuhu']),($fields['status']), date('d-m-Y', strtotime($fields['waktu'])), date('H:i:s', strtotime($fields['waktu']))));
}

fclose($fp);

?>