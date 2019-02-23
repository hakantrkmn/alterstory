

<div class="container sd">
  <div class="row">
    <div  class="col-md-12">
      <h1 class="my-4">Alternatif Devamlar</h1>
      <!–– EĞER TIKLANILAN HİKAYE ANA HİKAYEYSE O GÖSTERİLİR ––>
      <?php if ($_GET['seviye']==0): ?>
        <div class="card mb-4">
          <div class="card-body">
            <h2 align="center"class="card-title"><?php echo $rootStory->hikaye_baslik ?></h2>
            <p class="card-text"><?php echo $rootStory->hikaye_metin ?><br> <a href="profil/<?php echo $rootStory->kullanici->kullanici_adi  ?>"><?php echo $rootStory->kullanici->kullanici_adi ?></a>(<?php echo $rootStory->hikaye_tarih ?>)</p>
            <?php if ($rootStory->devamsayisi<3): ?>
                <?php if (isset($_SESSION['kullanici_adi'])): ?>
                  <?php if ($_SESSION['kullanici_adi']==$rootStory->kullanici->kullanici_adi): ?>
                  <?php elseif ($rootStory->izin()):?>
                  <?php elseif ($_SESSION['kullanici_ban']=="1"):?>
                  <?php else: ?>
                    <form class="" action="alteradd" method="post">
                      <input type="hidden" name="parentid" value="<?php echo $rootStory->hikaye_id ?>">
                      <input type="hidden" name="seviye" value="<?php echo $rootStory->hikaye_seviye ?>">
                    <button class="btn btn-primary btn-sm"type="submit">devam ettir &rarr;</button>
                  <?php endif; ?>
                <?php endif; ?>
              </form>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
      <!–– EĞER TIKLANILAN HİKAYE 1.SEVİYEYSE O GÖSTERİLİR ––>
      <?php if ($_GET['seviye']==1): ?>
        <div class="card mb-4">
          <div class="card-body">
            <h2 align="center"class="card-title"><?php echo $firstAlter->parent->hikaye_baslik ?></h2>
            <p class="card-text"><?php echo $firstAlter->parent->hikaye_metin ?><br>
             <a href="profil/<?php echo $firstAlter->parent->kullanici->kullanici_adi  ?>"><?php echo $firstAlter->parent->kullanici->kullanici_adi ?></a>
             (<?php echo $firstAlter->parent->hikaye_tarih ?>)
             <a  href="alterstories/<?php echo $firstAlter->parent->hikaye_id ?>/<?php echo $firstAlter->parent->hikaye_seviye?>" class=" btn-link  btn-sm">Hikayeye git <i class="fas fa-book-open"></i></a>
            </p>
            <p class="card-text"><?php echo $firstAlter->alterbir_metin ?> <br> <a href="profil/<?php echo $firstAlter->kullanici->kullanici_adi  ?>"><?php echo $firstAlter->kullanici->kullanici_adi ?></a>(<?php echo $firstAlter->alterbir_tarih ?>)</p>
                <?php if (isset($_SESSION['kullanici_adi'])): ?>
                  <?php if ($_SESSION['kullanici_adi']==$firstAlter->kullanici->kullanici_adi): ?>
                    <?php elseif ($_SESSION['kullanici_adi']==$firstAlter->parent->kullanici->kullanici_adi):?>
                    <?php elseif ($firstAlter->devamsayisi>=3):?>
                    <?php elseif ($_SESSION['kullanici_ban']=="1"):?>
                    <?php else: ?>
                      <form class="" action="alteradd" method="post">
                      <input type="hidden" name="parentid" value="<?php echo $firstAlter->alterbir_id ?>">
                      <input type="hidden" name="seviye" value="<?php echo $firstAlter->alterbir_seviye ?>">
                      <button class="btn btn-primary btn-sm"type="submit">devam ettir &rarr;</button>
                      </form>
                  <?php endif; ?>
                <?php endif; ?>
          </div>
        <?php endif; ?>
    </div>
    <!–– EĞER TIKLANILAN HİKAYE ANA HİKAYEYSE ONA GÖRE ALTERNATİFLER GÖSTERİLİR ––>
    <?php if ($_GET['seviye']==0): ?>
    <?php for($i=0;$i<3;$i++): ?>
    <?php if (is_object($rootStory->devamlar[$i])): ?>
        <div class="col-md-<?php echo 12/($rootStory->devamsayisi) ?>">
          <div id="qwe"class="card mb-4">
            <div class="card-body">
              <p id="metin"class="card-text qw"><?php echo $rootStory->devamlar[$i]->alterbir_metin?> <br> <a href="profil/<?php echo $rootStory->devamlar[$i]->kullanici->kullanici_adi  ?>"><?php echo $rootStory->devamlar[$i]->kullanici->kullanici_adi ?></a>(<?php echo $rootStory->devamlar[$i]->alterbir_tarih ?>)</p>
              <a href="alterstories/<?php echo $rootStory->devamlar[$i]->alterbir_id ?>/<?php echo $rootStory->devamlar[$i]->alterbir_seviye ?>/<?php echo $rootStory->devamlar[$i]->alterbir_parentid ?>" class="btn btn-primary btn-sm">Alternatif Devamlar &rarr;</a>
              <?php if ($rootStory->devamsayisi > 1): ?>
                <button type="button" class="btn btn-primary silme btn-sm" name="button">Oku</button>
                <?php else: ?>
                <button type="button" onclick="oku()" class="btn btn-primary  btn-sm" >Oku</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php endfor; ?>
      <?php if ($rootStory->devamsayisi==0): ?>
        <div id="uyari" class="col-md-12">
          <div class="card">
              <div class="card-body text-center">
                     Bu hikayeye henüz alternatif bir devam eklenmemiş gibi gözüküyor.
               </div>
           </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    </div>
    <!–– EĞER TIKLANILAN HİKAYE 1.SEVİYEYSE ONA GÖRE ALTERNATİFLER GÖSTERİLİR ––>
    <?php if ($_GET['seviye']==1): ?>
    <?php for($i=0;$i<3;$i++): ?>
    <?php if (is_object($firstAlter->devamlar[$i])): ?>
        <div class="col-md-<?php echo 12/$firstAlter->devamsayisi ?>">
        <div class="card mb-4">
            <div class="card-body">
              <p id="metin"class="card-text qw"><?php echo $firstAlter->devamlar[$i]->alteriki_metin ?> <br> 
              <a href="profil/<?php echo $firstAlter->devamlar[$i]->kullanici->kullanici_adi  ?>"><?php echo $firstAlter->devamlar[$i]->kullanici->kullanici_adi ?>
              </a>
              (<?php echo $firstAlter->devamlar[$i]->alteriki_tarih ?>)
              </p>
              <a href="readstory/<?php echo $firstAlter->devamlar[$i]->alteriki_id ?>/<?php echo $firstAlter->devamlar[$i]->alteriki_seviye ?>/<?php echo $firstAlter->devamlar[$i]->alteriki_parentid ?>" class="btn btn-primary btn-sm">Hikayeyi Oku&rarr;</a>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php endfor; ?>
      <?php if ($firstAlter->devamsayisi==0): ?>
        <div id="uyari" class="col-md-12">
          <div class="card">
              <div class="card-body text-center">
                     Bu hikayeye henüz alternatif bir son eklenmemiş gibi gözüküyor.
               </div>
           </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
<script>
setTimeout(function() {
        $("#uyari").fadeOut();
    }, 5000);
</script>


