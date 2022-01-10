  <?php 

    include 'include/includedFiles.php'; 

  ?>

  <div class="subHeadingWrapper subArtist">
    <h2>All Artists</h2>
  </div>

  <div class="gridViewContainer">

    <?php 

      $artists = $artist_obj->getArtists();

      foreach ($artists as $artist) {
        
        include 'include/artistCard.php';
      }

    ?>
   

  </div> <!-- end .gridViewContainer-->