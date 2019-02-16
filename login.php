
<?php





include 'wiew/header.php';
include 'class.php';


$yanlisgiris;






?>






<div class="container sd">

 <div class="login-form">
    <form id="myform" action="" method="post">
        <h2 class="text-center">Giriş Yap</h2>
          <div id="asd"style="display: none" align="center" class="alert alert-danger">
    <strong>Bilgiler yanlış</strong></div>

        <div class="form-group">
            <input id="kadi" name="kullanici_adi" type="text" class="form-control" placeholder="Kullanıcı Adı" required="required">
        </div>
        <div class="form-group">
            <input id="ksifre" type="password" name="kullanici_sifre" class="form-control" placeholder="Şifre" required="required">
        </div>
        <div class="form-group">
            <button onclick="sorgu2()" id="giris" type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
            <a  id="giris" href="kayit" class="btn btn-primary btn-block">Kayıt Ol</a>
        </div>
    </form>

</div>

</div>

<?php
include 'wiew/footer.php';

?>
