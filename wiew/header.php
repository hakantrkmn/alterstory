<?php

if (isset($_GET['cikis']) ) {
  if ($_GET['cikis']==1) {
    session_destroy();
    header("Location: index/1");
    $cikis=0;
  }



}

?>


<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <!-- Bootstrap CSS -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="alternatif hikayeler üretme">
  <meta name="author" content="hakan türkmen">

  <title>AlterStory</title>
  <link rel="shortcut icon" href="favicon.ico">
  <base href="/hikaye2/" >

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.0/css/mdb.min.css" rel="stylesheet">

  <!-- JQuery -->
  <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.0/js/mdb.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
  <script type="text/javascript" src="deneme.js"></script>
  <link href="css/blog-home.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index/1">alterstory</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="profil/<?php echo $_SESSION['kullanici_adi']  ?>"><?php if (isset($_SESSION['kullanici_adi'])): ?>
              <?php echo $_SESSION['kullanici_adi'] ?>
            <?php endif; ?></a>

          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['kullanici_adi'])): ?>
              <a class="nav-link" href="anahikayeyaz">

                Hikaye Yaz <i class="fas fa-pen"></i>

              </a>

            <?php else: ?>
              <a class="nav-link" onclick="noUser()">

                Hikaye Yaz <i class="fas fa-pen"></i>

              </a>
            <?php endif; ?>






          </li>
          <?php if (isset($_SESSION['kullanici_adi'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?cikis=1">

                Çıkış Yap <i class="fas fa-sign-out-alt"></i>

              </a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['kullanici_adi'])): ?>


            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="login">

                  Giriş Yap/Kayıt Ol

                </a>


              </li>
            <?php endif; ?>


          </ul>
        </div>
      </div>
    </nav>
