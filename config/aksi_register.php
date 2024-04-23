<?php

include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$sql = mysqli_query($koneksi, "INSERT INTO USER VALUES ('','$username','$password','$email', '$namalengkap', '$alamat')");
if ($sql) {
   echo "<script>alert('Selamat Anda Berhasil Membuat Akun Baru'); location.href='../login.php'</script>";
} else {
   echo "<script>alert('Mohon Maaf Anda Gagal Mendaftarkan Akun Anda'); location.href='../register.php'</script>";
}

?>
