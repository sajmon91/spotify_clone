  <?php 

    include 'include/includedFiles.php'; 

  ?>

  <div class="subHeadingWrapper subPlaylist">
    <h2>All Playlists</h2>
  </div>

  <div class="gridViewContainer">

    <?php

      $playlists = $playlist_obj->getPlaylists();

      foreach ($playlists as $play){

        include 'include/playlistCard.php';
      }
    
    ?>            

  </div> <!-- end .gridViewContainer-->