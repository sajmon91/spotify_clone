<?php 

  include 'include/includedFiles.php'; 

  if (isset($_GET['id'])) {
    
    $artistId = htmlspecialchars(strip_tags(trim($_GET['id'])));
  }else{
    redirect('index.php');
  }

  $artist = $artist_obj->getArtistById($artistId);
  $totalSong = $artist_obj->countSongsFromArtist($artistId);
  $totalAlbums = $artist_obj->countAlbumsFromArtist($artistId);



 ?>


  <div class="entityInfo artistEntity borderBottom" style="background-image: url('<?php echo $artist->artistPic; ?>');">
    <div class="centerSection">
      <div class="artistInfo">
        <p>Artist</p>
        <h1 class="artistName"><?php echo $artist->name; ?></h1>
      </div>
    </div>
  </div>
  

  <div class="headerButtons">
    <button class="button green" onclick="playFirstSong()"><img src="assets/images/icons/play-white.png" alt="Play Button"></button>
    <div class="info">
      <p>Total <?php echo $totalSong->total; ?> songs and <?php echo $totalAlbums->total; ?> albums</p>
    </div>
  </div>

  <div class="trackListContainer borderBottom">
      <h2>Top Songs</h2>

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

          $artistSongs = $artist_obj->getSongsFromArtistId($artistId);

            $i = 1;
            foreach ($artistSongs as $song) {

              echo "
                  <li class='tracklistRow'>
                      <div class='trackCount'>
                        <img class='plays albumPlays' data-songId ={$song->id} src='assets/images/icons/play-white.png'>
                        <span class='trackNumber'>{$i}</span>
                      </div>


                      <div class='trackInfo'>
                        <span role='link' tabindex='0' onclick='openPage(\"song.php?id=" . $song->id . "\")'>
                          <span class='trackName'>{$song->title}</span>
                        </span>
                      </div>

                      <div class='trackPlays'>
                        <span>{$song->plays}</span>
                      </div>

                      <div class='trackOptions'>
                        <input type='hidden' class='S' value='{$song->id}'>
                        <img class='optionsButton' src='assets/images/icons/more.png'>
                      </div>

                      <div class='trackDuration'>
                        <span class='duration'>{$song->duration}</span>
                      </div>
                    </li>
              ";

              $i++;
            }

	    	 ?>

	    </ul> <!-- end .trackList-->

	</div><!-- end .songGridViewContainer-->


  <div class="gridViewContainer">

      <h2 class="artistAlbums">Albums</h2>

    <?php 

      $artistAlbums = $artist_obj->getAlbumsFromArtistId($artistId);

      foreach ($artistAlbums as $album) {

        echo "
              <div class='gridViewItem'>
                
                  <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $album->id . "\")'>
                    <img src='{$album->artworkPath}'>
                  </span>
                    <div class='gridViewInfo'>
                      <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $album->id . "\")'>
                        <span class='album'>{$album->title}</span>
                      </span>
                    </div>
              </div>
        ";
      }

    ?>

  </div> <!-- end .gridViewContainer-->

  <?php 
    include 'include/optionsMenu.php';
  ?>