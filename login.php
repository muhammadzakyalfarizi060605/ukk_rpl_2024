<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Website Galeri Foto MZA</title>
   <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
   <style>
      a {
         text-decoration: none;
      }

      .navbar {
         background-color: #f0f0f0;
         padding: 10px 50px;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .navbar-logo {
         font-size: 20px;
      }

      .navbar-logo img {
         height: 30px;
         margin-right: 10px;
      }

      .navbar-icon {
         float: right;
      }
   </style>
</head>

<body>
   <div class="navbar">
      <div class="navbar-logo">
         Website Galeri Foto MZA
      </div>
      <div class="navbar-icon">
         <img src="assets/img/gambarkamera.jpg" alt="Ikon Navbar" width="50px">
      </div>
   </div>
   <div class="container py-5">
      <div class="row justify-content-center">
         <div class="col-md-4">
            <div class="card">
               <div class="card-body bg-light">
                  <div class="text-center">
                     <h5>Login Aplikasi</h5>
                  </div>
                  <form action="config/aksi_login.php" method="POST">
                     <label class="form-label">Username</label>
                     <input type="text" name="username" class="form-control" required>
                     <label class="form-label">Password</label>
                     <input type="password" name="password" class="form-control" required>
                     <div class="d-grid mt-2">
                        <button class="btn btn-primary" type="submit" name="kirim">MASUK</button>
                     </div>
                  </form>
                  <hr>
                  <p style="text-align: center;">Belum Punya Akun ? <a href="register.php">Silahkan Daftar Akun</a></p>
               </div>
            </div>
         </div>

      </div>
   </div>
   <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
      <p>&copy; UKK RPL 2024 | MUHAMMAD ZAKY ALFARIZI</p>
   </footer>
   <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>