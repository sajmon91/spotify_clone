<?php

  $song = $song_obj->getSongById($songId);
  $songArtist = $artist_obj->getArtistById($song->artist);

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
              <span class='artistName'>{$songArtist->name}</span>
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










?>