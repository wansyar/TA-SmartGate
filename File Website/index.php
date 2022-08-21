<?php
session_start();
  //Koneksi Database
  $server = "localhost";
  $user = "fisikami_tbldata" ;
  $pass = "^hmnGPD917by" ;
  $database= "fisikami_tugasakhir";
  
if( !isset($_SESSION["login"]))
{
    header("Location: login.php");
    exit;
}
  $koneksi = mysqli_connect ($server,$user,$pass,$database) or die (mysqli_error($koneksi));
?>



<!doctype html>
<html lang="en"></html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">

    <!-- Font Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Style-->
    <link rel="stylesheet" href="css/style.css">

    <!--Responsive-->
    <link rel="stylesheet" href="css/responsive.css">

 <!--Proses Realtime-->
 <script src="jquery/jquery.min.js"></script>

<script type="text/javascript"> 
$(document).ready(function() {
  setInterval(function() {
    $("#ceksuhu").load('ceksuhu.php');
    $("#cekstatus").load('cekstatus.php');
    $("#ceknama").load('ceknama.php');
  }, 1000);
}) ;

</script>
<link rel="icon" href="Assets/img/Logo Fisika.png" type="image/x-icon">
    
    <title>Smart Gate</title>
  </head>
  <body>

    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-fixed w-100">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="Assets/img/Logo Fisika.png" alt="" width="30" class="d-inline-block align-text-top me-1">
          Smart Gate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Welcome To Our Website</a>
            </li>
          </ul>
          <div>
        <a href="https://fisika-mipa-unsri.com/modul/suhu.php">
            <button class="button-primary">Home</button></a>
            <?php if(isset($_SESSION['login'])){ ?>
            <a href='export_data.php'>
            <button class="button-secundary">Download</button> </a>
             <?php } ?>
          </div> 
        </div>
      </div>
    </nav>

    <!-- Hero Section-->
    <section id="hero">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-md-6 hero-tagline my-auto">
            <h1>Memonitoring Pencegahan
                Penyebaran Covid-19</h1>
                <p><span class="fw-bold">Smart Gate Dengan Input Data Suhu</span>  hadir untuk membantu pencegahan penyebaran virus Covid-19</p>
                
                 <h6>Akses Langsung:</h6>
                 <a href ="#layanan">
                <button class="button-lg-primary">Lihat Riwayat Monitoring Smart Gate</button> </a>
                <a href ="#">
                  <img src ="Assets/img/Vector.png" alt="" class="vector mx-6" width="16">
                </a>
          </div>
        </div>
        <img src="Assets/img/Dokter.png" alt="" class= "position-absolute start-0 bottom-0 img-hero">
      </div>
    </section>

    <!--Layanan Section-->
    <section id="layanan">
      <div class="container">
        <div class="row"> 
          <div class="col-12 text-center">
            <h2> Table Monitoring </h2>
            <span class="sub-title"> Berisikan Data Monitoring Secara Realtime </span>
          </div>

        </div>

        <div class="row mt-5">
          <!-- Card 1-->
          <div class="col-md-4 text-center">
            <div class="card-layanan">
                <div class="circle-icon position-relative mx-auto">
                  <img src="Assets/img/Orang.png" alt="" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <br>
                <h3>
                <span id="ceknama"></span
                </h3 class="mt-4">
                <p class="mt-3">Adalah nama anda yang terdaftar pada QR-Code,
                ukur Suhu Tubuh anda, Silahkan masuk</p>
            </div>
          </div>
<!-- Card 2-->
          <div class="col-md-4 text-center">
            <div class="card-layanan">
                <div class="circle-icon position-relative mx-auto">
                  <img src="Assets/img/Suhu.png" alt="" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <br>
                <h3>
                <span id="ceksuhu"> 36</span> °C 
                </h3 class="mt-4">
                <p class="mt-3">Nilai dari pengukuran suhu tubuh anda, antara 35 sampai 37 °C masih kategori normal, selebih nya suhu tubuh anda tidak normal</p>
            </div>
          </div>

          <!-- Card 3-->
          <div class="col-md-4 text-center">
            <div class="card-layanan">
                <div class="circle-icon position-relative mx-auto">
                  <img src="Assets/img/Pintu.png" alt="" class="position-absolute top-50 start-50 translate-middle">
                </div>
                <br>
                <h3>
                <span id="cekstatus"> Terbuka </span>
                </h3 class="mt-4">
                <p class="mt-3">Menampilkan kondisi gerbang terbuka atau tertutup sesuai nilai suhu tubuh </p>
            </div>
          </div>

        </div>
</section>
        <section id="riwayat">
        <div class="container">
        <div class="row"> 
          <div class="col-12 text-center">
              <h2> Riwayat Monitoring </h2>
            <span class="sub-title"> Menampilkan Riwayat Monitoring </span>
            
        <div class= "card mt-5">
          <div class ="card-header text-white">
            Riwayat Masuk
          </div>
          
          
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th> Pengukuran Suhu</th>
                <th> Kondisi Pintu </th>
                <th>Waktu</th>
                <th>Aksi </th>
          </tr>
<!--Awal Riwayat-->

          <?php
  $no=1;
  $tampil= mysqli_query($koneksi, "SELECT*FROM monitoring order by id desc limit 10");
  while($data = mysqli_fetch_array($tampil)):
  $status=$data['besarsuhu'] >=35 &&$data['besarsuhu']<=37 ? 'Terbuka' : 'Tertutup';
?>
<tr>
  <td><?=$no++;?></td>
  <td><?=$data['Nama']?></td>
  <td><?=$data['besarsuhu']?>°C</td>
  <td><?=$data['status']?></td> 
  <td><?=$data['waktu']?></td>
  <td>
    <a href="index.php?hal=hapus&id=<?=$data['id']?>" 
    onclick="return confirm('Apakah Yakin Ingin Menghapus Data ini?')" class="btn btn-danger"> Hapus </a>
  </td>
  
</tr>
<?php endwhile; // Penutup dari perulangan?>
  </table>
        </div>
  </div>
  </div>
  </div>
        <!-- Akhir Riwayat-->

    </section>

<script src="js/script.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    -->
  </body>
</html>