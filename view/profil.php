<?php


include 'view/header.php';
?>
<!-- Page Content -->
<div class="container sd">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-12">

      <h1 class="my-4 baslik">Başlattığı Hikayeler
      </h1>
<?php foreach ($user->rootStories as  $value): ?>


  <div class="card mb-4">
    <div class="card-body">
      <h2 align="center" class="card-title"><?php echo $value->hikaye_baslik ?></h2>
      <p class="card-text"><?php echo $value->hikaye_metin ?></p>
      <a href="?op=alterStories&hikaye_id=<?php echo $value->hikaye_id ?>&seviye=<?php echo $value->hikaye_seviye ?>" class="btn btn-primary">Hikayeye Git &rarr;</a>
      <?php if ($kendiProfili==1): ?>
        <form id="mform" style="display:inline-block;"class="" action="yukle.php" method="post">
          <button onclick="emin()" type="button"class="btn btn-danger">Hikayeyi Sil!</button>
          <input type="hidden" name="hikaye_id" value="<?php echo $value->hikaye_id ?>">
          <input type="hidden" name="seviye" value="<?php echo $value->hikaye_seviye ?>">
          <input type="hidden" name="sil" value="1">

        </form>
<?php endif; ?>

    </div>
  </div>
<?php endforeach; ?>
<h2 class="my-4 baslik">Birinci Alternatifler
</h2>

<?php foreach ($user->firstAlters as  $value): ?>
<div class="card mb-4">
<div class="card-body">
<p class="card-text"><?php echo $value->alterbir_metin ?></p>
<a href="?op=alterStories&hikaye_id=<?php echo $value->alterbir_id ?>&seviye=<?php echo $value->alterbir_seviye ?>" class="btn btn-primary">Hikayeye Git &rarr;</a>
<?php if ($kendiProfili==1): ?>
  <form id="mform" style="display:inline-block;"class="" action="yukle.php" method="post">
    <button onclick="emin()" type="button"class="btn btn-danger" name="button">Hikayeyi Sil!</button>
    <input type="hidden" name="hikaye_id" value="<?php echo $value->alterbir_id ?>">
    <input type="hidden" name="seviye" value="<?php echo $value->alterbir_seviye ?>">
    <input type="hidden" name="sil" value="1">

  </form>

<?php endif; ?>



</div>
</div>
<?php endforeach; ?>


<h3 class="my-4 baslik">İkinci Alternatifler
</h3>

<?php foreach ($user->secondAlters as  $value): ?>
<div class="card mb-4">
<div class="card-body">
<p class="card-text"><?php echo $value->alteriki_metin ?></p>
<a href="hikayeoku.php?hikaye_id=<?php echo $value->alteriki_id ?>&seviye=<?php echo $value->alteriki_seviye ?>&id=<?php echo $value->alteriki_parentid ?>" class="btn btn-primary">Hikayeyi Oku&rarr;</a>
<?php if ($kendiProfili==1): ?>
  <form id="mform" style="display:inline-block;"class="" action="?op=deleteStory" method="post">
    <button onclick="emin()" type="button"class="btn btn-danger">Hikayeyi Sil!</button>
    <input type="hidden" name="hikaye_id" value="<?php echo $value->alteriki_id ?>">
    <input type="hidden" name="seviye" value="<?php echo $value->alteriki_seviye ?>">
    <input type="hidden" name="sil" value="1">

  </form>
<?php endif; ?>
</div>

</div>
<?php endforeach; ?>






    </div>
  </div>


  <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer --><?php             include 'view/footer.php';
 ?>
