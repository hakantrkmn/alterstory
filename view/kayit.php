<?php

include 'view/header.php';
?>
<div class="container sd">

 <div class="login-form">
    <form id="myform" action="?op=insertUser" method="POST" >
        <h2 class="text-center"> Kayıt Ol</h2>
        <div id="asd"style="display: none;" align="center" class="alert alert-danger">
  <strong>Kullanıcı mevcut</strong></div>
  <div id="basari"style="display: none;" align="center" class="alert alert-success">
<strong>Kayıt Başarılı</strong></div>

        <?php if ($yanlisgiris==1): ?>
          <?php echo "yanlis giriş yaptınız" ?>

        <?php endif; ?>
        <div class="form-group">

            <input id="kadi" name="kullanici_adi" type="text" class="form-control" placeholder="Kullanıcı Adı" required="required">
        </div>
        <div class="form-group">
            <input id="kmail" name="kullanici_mail" type="email" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input id="ksifre" type="password" name="kullanici_sifre" class="form-control" placeholder="Şifre" required="required">
        </div>
        <div class="form-group">
            <input id="dogrulama" type="password" class="form-control " placeholder="Şifre Tekrar"  required="required">

        </div>
        <div id="warn" style="display:none" class="form-group">
          <div class="card text-center">
          <div class="card-body">
          Şifreler uyuşmuyor!
          </div>
          </div>
        </div>

        <div class="form-group">
            <button onclick="sorgu()" id="kayit" type="submit" class="btn btn-primary btn-block">Kayıt ol</button>
        </div>
    </form>

</div>

</div>


<?php include 'view/footer.php'; ?>
