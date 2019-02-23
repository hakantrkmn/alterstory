<div class="container sd">
  <div class="row">
      <div class="col-md-12">
      <h1 class="my-4">Tüm Hikaye</h1>
      <!–– TIKLANAN HİKAYENİN ANA HİKAYESİ ––>
      <div class="card mb-4">
        <div class="card-body">
          <h2 align="center"class="card-title"><?php echo $secondAlter->parent->parent->hikaye_baslik ?></h2>
          <p class="card-text"><?php echo $secondAlter->parent->parent->hikaye_metin ?> <br> <a href="profil.php?kullanici=<?php echo $secondAlter->parent->parent->kullanici->kullanici_adi  ?>"><?php echo $secondAlter->parent->parent->kullanici->kullanici_adi ?></a>(<?php echo $secondAlter->parent->parent->hikaye_tarih ?>)
            <a href="altergör.php?hikaye_id=<?php echo $secondAlter->parent->parent->hikaye_id ?>&seviye=<?php echo $secondAlter->parent->parent->hikaye_seviye ?>">Hikayeye git <i class="fas fa-book-open"></i></a></p>
            <!–– TIKLANAN HİKAYENİN BİRİNCİ ALTERNATİFİ  ––>
            <p class="card-text"><?php echo $secondAlter->parent->alterbir_metin ?> <br> <a href="profil.php?kullanici=<?php echo $secondAlter->parent->kullanici->kullanici_adi  ?>"><?php echo $secondAlter->parent->kullanici->kullanici_adi ?></a>(<?php echo $secondAlter->parent->alterbir_tarih ?>)<a href="altergör.php?hikaye_id=<?php echo $secondAlter->parent->alterbir_id ?>&seviye=<?php echo $secondAlter->parent->alterbir_seviye ?>&id=<?php echo $secondAlter->parent->alterbir_parentid ?>">Hikayeye git <i class="fas fa-book-open"></i></a></p>
            <!–– TIKLANAN HİKAYENİN KENDİSİ ––>
            <p class="card-text"><?php echo $secondAlter->alteriki_metin ?> <br> <a href="profil.php?kullanici=<?php echo $secondAlter->kullanici->kullanici_adi  ?>"><?php echo $secondAlter->kullanici->kullanici_adi ?></a>(<?php echo $secondAlter->alteriki_tarih ?>)</p>
          </div>
        </div>
      </div>
    </div>
  </div>
