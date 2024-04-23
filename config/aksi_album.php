<?php
session_start();
include "koneksi.php";

if (isset($_POST['tambah'])) {
   $namaalbum = $_POST['namaalbum'];
   $deskripsi = $_POST['deskripsi'];
   $tanggal = date('Y-m-d');
   $userid = $_SESSION['userid'];

   $sql = mysqli_query($koneksi, "INSERT INTO ALBUM VALUES ('','$namaalbum','$deskripsi','$tanggal','$userid')");

   echo "<script>alert('Selamat Data Berhasil Disimpan'); location.href='../admin/album.php'</script>";
}

if (isset($_POST['edit'])) {
   $albumid = $_POST['albumid'];
   $namaalbum = $_POST['namaalbum'];
   $deskripsi = $_POST['deskripsi'];
   $tanggal = date('Y-m-d');
   $userid = $_SESSION['userid'];

   $sql = mysqli_query($koneksi, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi', tanggaldibuat='$tanggal' WHERE albumid='$albumid'");

   echo "<script>alert('Selamat Data Berhasil Diperbaharui'); location.href='../admin/album.php'</script>";
}

if (isset($_POST['hapus'])) {
   $albumid = $_POST['albumid'];

   // Periksa apakah album memiliki anak data (foto)
   $cekAnakData = mysqli_query($koneksi, "SELECT * FROM foto WHERE albumid='$albumid'");
   $jumlahAnakData = mysqli_num_rows($cekAnakData);

   if ($jumlahAnakData > 0) {
      // Jika ada anak data, tampilkan alert dan batalkan penghapusan
      echo "<script>alert('Data Album tidak dapat dihapus karena masih memiliki anak data'); location.href='../admin/album.php'</script>";
   } else {
      // Jika tidak ada anak data, hapus album dan tampilkan alert
      $sql = mysqli_query($koneksi, "DELETE FROM album WHERE albumid='$albumid'");
      echo "<script>alert('Selamat data album berhasil dihapus.'); location.href='../admin/album.php'</script>";
   }
}
