  <?php 

    include 'include/includedFiles.php'; 

  ?>

  <div class="subHeadingWrapper subAlbum">
    <h2>All Albums</h2>
  </div>

  <div class="gridViewContainer">

    <?php 

      $albums = $album_obj->getAlbums();

      foreach ($albums as $album) {

       include 'include/albumCard.php';
      }

    ?>

  </div> <!-- end .gridViewContainer-->