<?php

  echo "
    <div class='gridViewItem playlistCard'>
      <span role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $play->id . "\")'>
        <img src='assets/images/playlists-img/{$play->playlistImg}'>
        <div class='gridViewInfo'>
          <span class='album'>{$play->name}</span>
          <span>By: {$user_obj->getUsername($play->userId)}</span>
        </div>
      </span>
    </div>
  ";




?>