  <?php 

    include 'include/includedFiles.php'; 

  ?>

  <div class="subHeadingWrapper subSongs">
    <h2>All Songs</h2>
  </div>

  <div class="songGridViewContainer">

    <div class="listInfo">
      <span class="no">#</span>
      <span class="ti">Title</span>
      <span class="pl">Plays</span>
      <span class="im">
        <img src="assets/images/icons/clock.png" alt="time">
      </span>
    </div>

    <ul class="trackList">

      <?php

        $randomSongs = $song_obj->getRandomSongs();

        $i = 1;
        foreach ($randomSongs as $songId) {
          
          include 'include/songCard.php';

          $i++;
        }
      
      ?>

    </ul> <!-- end .trackList-->

  </div><!-- end .songGridViewContainer-->

  <?php 
    include 'include/optionsMenu.php';
  ?>