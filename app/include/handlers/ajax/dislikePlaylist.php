<?php 

  include '../../init.php';

  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

  if($contentType === "application/json"){

    $content = trim(file_get_contents('php://input'));

    $decoded = json_decode($content);

    $likes_obj->dislikePlaylist($decoded->playlistId, $decoded->userId);

  }




?>