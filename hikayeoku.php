<?php

include 'class.php';
include 'classes/secondAlter.php';
$Nhikaye = new alter2hikaye();
$Nhikaye->getStory($_GET['seviye'],$_GET['hikaye_id']);
$birincialternatif = $Nhikaye->getParentStory();
$anahikaye = $Nhikaye->getRootVideo($birincialternatif->alterbir_parentid);

$sa = secondAlter::find($_GET['hikaye_id']);

include 'wiew/header.php';
?>

<pre><?php echo var_dump($sa->parent->parent);
 ?> </pre>


<!-- Page Content -->
<div class="container sd">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-12">

      <h1 class="my-4">Tüm Hikaye
      </h1>

      <!–– TIKLANAN HİKAYENİN ANA HİKAYESİ ––>

      <div class="card mb-4">
        <div class="card-body">
          <h2 align="center"class="card-title"><?php echo $anahikaye->hikaye_baslik ?></h2>
          <p class="card-text"><?php echo $anahikaye->hikaye_metin ?> <br> <a href="profil.php?kullanici=<?php echo $anahikaye->kullanici_adi  ?>"><?php echo $anahikaye->kullanici_adi ?></a>(<?php echo $anahikaye->hikaye_tarih ?>)
            <a href="altergör.php?hikaye_id=<?php echo $anahikaye->hikaye_id ?>&seviye=<?php echo $anahikaye->hikaye_seviye ?>">Hikayeye git <i class="fas fa-book-open"></i></a></p>

            <!–– TIKLANAN HİKAYENİN BİRİNCİ ALTERNATİFİ  ––>
            <p class="card-text"><?php echo $birincialternatif->alterbir_metin ?> <br> <a href="profil.php?kullanici=<?php echo $birincialternatif->kullanici_adi  ?>"><?php echo $birincialternatif->kullanici_adi ?></a>(<?php echo $birincialternatif->alterbir_tarih ?>)<a href="altergör.php?hikaye_id=<?php echo $birincialternatif->alterbir_id ?>&seviye=<?php echo $birincialternatif->alterbir_seviye ?>&id=<?php echo $birincialternatif->alterbir_parentid ?>">Hikayeye git <i class="fas fa-book-open"></i></a></p>

            <!–– TIKLANAN HİKAYENİN KENDİSİ ––>
            <p class="card-text"><?php echo $Nhikaye->alteriki_metin ?> <br> <a href="profil.php?kullanici=<?php echo $Nhikaye->kullanici_adi  ?>"><?php echo $Nhikaye->kullanici_adi ?></a>(<?php echo $Nhikaye->alteriki_tarih ?>)</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php             include 'wiew/footer.php';
 ?>
