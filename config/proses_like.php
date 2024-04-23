<?php
session_start();
include 'koneksi.php';

$fotoid = $_GET['fotoid'];
$userid = $_SESSION['userid'];

$cek_suka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

if(mysqli_num_rows($cek_suka) == 1){
   while($row = mysqli_fetch_array($cek_suka)){
      $likeid = $row['likeid'];
      $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE likeid='$likeid'");
      echo "<script>location.href='../admin/index.php'</script>";
   }
}else {
   $tanggallike = date('Y-m-d');
   $query = mysqli_query($koneksi, "INSERT INTO likefoto VALUES ('','$fotoid', '$userid', '$tanggallike')");

   echo "<script>location.href='../admin/index.php'</script>";
}



?>