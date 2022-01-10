
<?php 

  include 'include/includedFiles.php'; 

?>



          <h1 class="pageHeadingBig">You Might Also Like</h1>

          <!-- albums --------------------------------------------->
          <div class="subHeadingWrapper subAlbum">
            <h2>Albums</h2>
            <span onclick='openPage("allAlbums.php")'>See All</span>
          </div>

          <div class="gridViewContainer">

            <?php 

              $albums = $album_obj->getAlbums(6);

              foreach ($albums as $album) {

               include 'include/albumCard.php';
              }

            ?>

          </div> <!-- end .gridViewContainer-->

          <!-- artist ------------------------------------------->
          <div class="subHeadingWrapper subArtist">
            <h2>Artists</h2>
            <span onclick='openPage("allArtists.php")'>See All</span>
          </div>

          <div class="gridViewContainer">

            <?php 

              $artists = $artist_obj->getArtists(6);

              foreach ($artists as $artist) {
                
                include 'include/artistCard.php';
              }

            ?>
           

          </div> <!-- end .gridViewContainer-->

          <!-- songs ---------------------------------------->
          <div class="subHeadingWrapper subSongs">
            <h2>Songs</h2>
            <span onclick='openPage("allSongs.php")'>See All</span>
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

                $randomSongs = $song_obj->getRandomSongs(5);

                $i = 1;
                foreach ($randomSongs as $songId) {
                  
                  include 'include/songCard.php';

                  $i++;
                }
              
              ?>

            </ul> <!-- end .trackList-->

          </div><!-- end .songGridViewContainer-->

          <!-- playlists ----------------------------------------->
          <div class="subHeadingWrapper subPlaylist">
            <h2>Playlists</h2>
            <span onclick='openPage("allPlaylists.php")'>See All</span>
          </div>

          <div class="gridViewContainer">

            <?php

              $playlists = $playlist_obj->getPlaylists(6);

              foreach ($playlists as $play){

                include 'include/playlistCard.php';
              }
            
            ?>            

          </div> <!-- end .gridViewContainer-->

          <?php 
            include 'include/optionsMenu.php';
           ?>



 