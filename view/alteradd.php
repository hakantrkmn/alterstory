<div class="container sd">
  <div class="row">
    <div class="col-md-12">
      <h1 class="my-4">Kendi Alternatif Devamını Yaz</h1>
      <?php if ($_POST['seviye']==0): ?>
        <div class="card mb-4">
          <div class="card-body">
            <h2 align="center" class="card-title"><?php echo $rootStory->hikaye_baslik ?></h2>
            <p class="card-text"><?php echo $rootStory->hikaye_metin ?> <br> <a href="?op=profil&kullanici=<?php echo $rootStory->kullanici->kullanici_adi  ?>"><?php echo $rootStory->kullanici->kullanici_adi ?></a>(<?php echo $rootStory->hikaye_tarih ?>)</p>
          </div>
        </div>
      <?php endif; ?>
      <?php if ($_POST['seviye']==1): ?>
        <div class="card mb-4">
          <div class="card-body">
            <h2 align="center"class="card-title"><?php echo $firstAlter->parent->hikaye_baslik ?></h2>
            <p class="card-text"><?php echo $firstAlter->parent->hikaye_metin ?> <br> <a href="?op=profil&kullanici=<?php echo $firstAlter->parent->kullanici->kullanici_adi  ?>"><?php echo $firstAlter->parent->kullanici->kullanici_adi ?></a>(<?php echo $firstAlter->parent->hikaye_tarih ?>)</p>
            <p class="card-text"><?php echo $firstAlter->alterbir_metin ?> <br> <a href="?op=profil&kullanici=<?php echo $firstAlter->kullanici->kullanici_adi  ?>"><?php echo $firstAlter->kullanici->kullanici_adi ?></a>(<?php echo $firstAlter->alterbir_tarih ?>)</p>
          </div>
        </div>
      <?php endif; ?>
      <div class="card mb-4">
        <form method="post" action="?op=addAlter&parentid=<?php echo $_POST['parentid'] ; ?>&seviye=<?php echo $_POST['seviye'] ?>">
          <textarea  name="alter-metin" onkeyup="charcountupdate(this.value)" id="textbox"> </textarea>
          <div class="buton">
            <strong><span id="charcount"></span> karakter</strong>
            <button onclick="karakter()" id="buton" type="submit" class="btn btn-dark "> <?php if ($_POST['seviye']==1) {
              echo "Sonlandır";
            }
            else {
              echo "Devam Ettir";
            } ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>



