<?php 

  include '../../init.php';

  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

  if($contentType === "application/json"){

    $content = trim(file_get_contents('php://input'));

    $decoded = json_decode($content);

    $songResult = $song_obj->getSongById($decoded);
    $artistResult = $artist_obj->getArtistById($songResult->artist);
    $albumResult = $album_obj->getAlbumById($songResult->album);

    $obj = [
      'songId' => $songResult->id,
      'title' => $songResult->title,
      'artist' => $artistResult->name,
      'artistId' => $artistResult->id,
      'album' => $albumResult->title,
      'albumId' => $albumResult->id,
      'albumArtwork' => $albumResult->artworkPath,
      'duration' => $songResult->duration,
      'path' => $songResult->path,
      'albumOrder' => $songResult->albumOrder,
      'plays' => $songResult->plays
    ];

    echo json_encode($obj);

  }




?>