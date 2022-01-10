<?php

  echo "
    <div class='gridViewItem'>
      <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $album->id . "\")'>
        <img src='{$album->artworkPath}'>
      </span>
      <div class='gridViewInfo'>
        <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $album->id . "\")'>
          <span class='album'>{$album->title}</span>
        </span>
        
        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $album->artist . "\")'>
          <span class='artist'>{$artist_obj->getArtistById($album->artist)->name}</span>
        </span>
      </div>
    </div>
  ";








?>