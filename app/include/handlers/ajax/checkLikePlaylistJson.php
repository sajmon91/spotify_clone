<?php 

  include '../../init.php';

  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

  if($contentType === "application/json"){

    $content = trim(file_get_contents('php://input'));

    $decoded = json_decode($content);

    $likeResult = $likes_obj->checkLikePlaylist($decoded->playlistId, $decoded->userId);


     echo json_encode($likeResult);

  }




?>