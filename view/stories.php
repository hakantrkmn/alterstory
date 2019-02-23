    <div class="container sd">
      <div class="row">
        <div class="col-md-12">
          <h1 class="my-4 ">Hikayeler</h1>
          <?php foreach ($allArticles as $hikaye): ?>
            <div onclick="location.href='alterstories/<?php echo $hikaye->hikaye_id ?>/<?php echo $hikaye->hikaye_seviye ?>';"class="card mb-4">
              <div class="card-body">
                <h2 class="card-title" align="center"><?php echo $hikaye->hikaye_baslik ?></h2>
                <p class="card-text"><?php echo mb_substr($hikaye->hikaye_metin,0,200) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
          <ul class="pagination justify-content-center pg-blue pagination-lg">
            <?php for ($i=0;$i<$pageNumber;$i++): ?>
              <li class="page-item">
                <a class="page-link" href="page=<?php echo $i +1 ?>"> <?php echo $i +1 ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
    </div>