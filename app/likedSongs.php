<?php 

  include 'include/includedFiles.php'; 

?>


<div class="likedSongsContainer">

  <div class="info">
    <div class="infoImg">
      <img src="assets/images/playlists-img/like_songs.png" alt="like songs">
    </div>
    <div class="infoText">
      <h2>Liked Songs</h2>
      <p><?php echo $likes_obj->getNumberOfSongs($user_id); ?> songs, <img class="album-time" src="assets/images/icons/clock.png" alt="time"> <?php echo $likes_obj->getLikedSongsDuration($user_id); ?></p>
      <button class="button green" onclick="playFirstSong()"><img src="assets/images/icons/play-white.png" alt="Play Button"></button>
    </div>
  </div>

  <div class="likedSongs">
    <div class="songGridViewContainer">

      <div class="listInfo">
        <span class="no">#</span>
        <span class="ti">Title</span>
        <span class="im">
          <img src="assets/images/icons/clock.png" alt="time">
        </span>
      </div>

      <ul class="trackList">

        <?php 

        $songs = $likes_obj->likedSongs($user_id);

          $i = 1;
          foreach ($songs as $songId) {
            
            $song = $song_obj->getSongById($songId->id_song);
            $artist = $artist_obj->getArtistById($song->artist);

            echo "
                <li class='tracklistRow'>
                    <div class='trackCount'>
                      <img class='plays albumPlays' data-songId = {$song->id} src='assets/images/icons/play-white.png'>
                      <span class='trackNumber'>{$i}</span>
                    </div>


                    <div class='trackInfo'>
                      <span role='link' tabindex='0' onclick='openPage(\"song.php?id=" . $song->id . "\")'>
                        <span class='trackName'>{$song->title}</span>
                      </span>
                      <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $song->artist . "\")'>
                        <span class='artistName'>{$artist->name}</span>
                      </span>
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
  </div>

</div>

  <?php 
    include 'include/optionsMenu.php';
  ?>