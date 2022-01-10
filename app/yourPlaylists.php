<?php 

  include 'include/includedFiles.php'; 

?>


  <div class="playlistsContainer">
    <div class="gridViewContainer playlistWrapper">
      <h2>PLAYLISTS</h2>

      <div class="buttonItems">
        <button class="playlistButton">NEW PLAYLIST</button>
      </div>

      <div class="playlistHeading">
        <h3>My Playlists</h3>
      </div>

      <?php
      
        $playlists = $playlist_obj->getPlaylistByUser($user_id);

        if (count($playlists) == 0) {
          echo "<span class='noResult'>You don`t have any playlists yet.</span>";
        }else{

          foreach ($playlists as $play){

            include 'include/playlistCard.php';
          }

        }
      
      ?>

      <div class="playlistHeading">
        <h3>Liked Playlists</h3>
      </div>

      <?php
      
        $likedPlaylists = $playlist_obj->getLikedPlaylist($user_id);

        if (count($likedPlaylists) == 0) {
          echo "<span class='noResult'>You don`t like any playlists yet.</span>";
        }else{

          foreach ($likedPlaylists as $likePlay){

            echo "
              <div class='gridViewItem playlistCard'>
                <span role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $likePlay->id . "\")'>
                  <img src='assets/images/playlists-img/{$likePlay->playlistImg}'>
                  <div class='gridViewInfo'>
                    <span class='album'>{$likePlay->name}</span>
                    <span>By: {$user_obj->getUsername($likePlay->userId)}</span>
                  </div>
                </span>
              </div>
            ";
          }

        }
      
      ?>


    </div>
  </div>