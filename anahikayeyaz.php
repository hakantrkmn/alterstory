<?php
include 'class.php';
include 'wiew/header.php';
  ?>


      <!-- Page Content -->
      <div class="container sd">

        <div class="row">

          <!-- Blog Entries Column -->
          <div class="col-md-12">

            <h1 class="my-4 ">Hikayeni Başlat </h1>
            <!-- Blog Post -->

            <div class="card mb-4">
              <form method="post" action="yukle.php">
                <div class="form-group">
                  <input name="hikaye-baslik"  type="text" class="form-control" placeholder="Hikaye Başlığı" required="required">
                </div>
                <textarea name="hikaye-metin" onkeyup="charcountupdate(this.value)" id="textbox"> </textarea>
                <div class="buton">
                  <strong><span id="charcount"></span> karakter</strong>
                  <button id="buton" onclick="karakter()" type="submit" class="btn btn-primary">Başlat</button>
                </div>
              </form>
            </div>


          </div>


          <!-- /.row -->

        </div>

        </div>
        <!-- /.container -->
<?php             include 'wiew/footer.php';
 ?>
