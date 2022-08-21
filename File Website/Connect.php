<?php

$host = "localhost";
$user = "fisikami_tbldata";
$pass = "^hmnGPD917by";
$dbnm = "fisikami_tugasakhir";

$conn = mysqli_connect($host, $user, $pass); 

	if ($conn) { 
		$buka = mysqli_select_db($conn, $dbnm); 
        // die ("Selamat, Database OK");
		if (!$buka) { 
			die ("Maaf, Database tidak dapat dibuka".mysqli_connect_error()); 
		} 
	}else{ 
		die ("Maaf, Database Server tidak terhubung".mysqli_connect_error()); 
	}

?>