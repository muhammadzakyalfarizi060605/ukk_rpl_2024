<?php
session_start();
include "../config/koneksi.php";
if ($_SESSION['status'] != 'login') {
   echo "<script>alert('Mohon Maaf Anda Belum login'); location.href='../index.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Website Galeri Foto MZA</title>
   <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>

<body>
   <nav class="navbar navbar-expand-lg bg-body-secondary">
      <div class="container">
         <a class="navbar-brand" href="index.php">Website Galeri Foto MZA</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
               <a href="home.php" class="nav-link">Home</a>
               <a href="album.php" class="nav-link">Album</a>
               <a href="foto.php" class="nav-link">Foto</a>
            </div>
            <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
         </div>
      </div>
   </nav>

   <div class="container mt-3">
      <div class="row">
         <div class="col-md-4">
            <div class="card mt-2">
               <div class="card-header">Tambah Data Foto</div>
               <div class="card-body">
                  <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                     <label class="form-label">Judul Foto</label>
                     <input type="text" name="judulfoto" class="form-control" required>
                     <label class="form-label">Deskripsi Foto</label>
                     <textarea name="deskripsifoto" class="form-control" required></textarea>
                     <label class="form-label">Jenis Album</label>
                     <select class="form-control" name="albumid">
                        <?php
                        $userid = $_SESSION['userid'];
                        $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                        while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                           <option value="<?php echo $data_album['albumid'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                        <?php } ?>
                     </select>
                     <label class="form-label">Pilih Gambar</label>
                     <input type="file" name="lokasifile" class="form-control" required>
                     <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah Data</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="card mt-2">
               <div class="card-header">Detail Data Foto</div>
               <div class="card-body">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Foto</th>
                           <th>Judul Foto</th>
                           <th>Deskripsi</th>
                           <th>Tanggal</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $no = 1;
                        $userid = $_SESSION['userid'];
                        $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                           <tr>
                              <td><?php echo $no++ ?></td>
                              <td><img src="../assets/img/<?php echo $data['lokasifile'] ?>" alt="Gambar Tidak Bisa Ditampilkan" width="100"></td>
                              <td><?php echo $data['judulfoto'] ?></td>
                              <td><?php echo $data['deskripsifoto'] ?></td>
                              <td><?php echo $data['tanggalunggah'] ?></td>
                              <td>
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">
                                    Edit
                                 </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                <label class="form-label">Judul Foto</label>
                                                <input type="text" name="judulfoto" class="form-control" value="<?php echo $data['judulfoto'] ?>">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea name="deskripsifoto" class="form-control"><?php echo $data['deskripsifoto']; ?></textarea>
                                                <label class="form-label">Jenis Album</label>
                                                <select class="form-control" name="albumid">
                                                   <?php
                                                   $userid = $_SESSION['userid'];
                                                   $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                                   while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                      <option <?php if ($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                                                   <?php } ?>
                                                </select>
                                                <label class="form-label">Foto</label>
                                                <div class="row">
                                                   <div class="col-md-4">
                                                      <img src="../assets/img/<?php echo $data['lokasifile'] ?>" alt="Gambar Tidak Bisa Ditampilkan" width="100">
                                                   </div>
                                                   <div class="col-md-8">
                                                      <label class="form-label">Pilih Gambar</label>
                                                      <input type="file" name="lokasifile" class="form-control">
                                                   </div>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Button trigger Modal -->
                                 <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
                                    Hapus
                                 </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="../config/aksi_foto.php" method="POST">
                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                Apakah anda yakin ingin menghapus data foto <b><?php echo $data['judulfoto'] ?></b>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
      <p>&copy; UKK RPL 2024 | MUHAMMAD ZAKY ALFARIZI</p>
   </footer>
   <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>