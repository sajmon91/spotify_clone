<?php

  echo "
      <div class='gridViewItem artistCard'>
        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artist->id . "\")'>
          <img src='{$artist->artistPic}'>
          <div class='gridViewInfo'>
            <span class='cardName'>{$artist->name}</span>
          </div>
        </span>
      </div>
  ";




?>