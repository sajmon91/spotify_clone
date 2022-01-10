<?php


include '../../init.php';


  if (isset($_FILES['albumArtwork']) && isset($_POST['albumTitle']) && isset($_POST['artist']) && isset($_POST['genre'])) {

    $insert = $album_obj->addNewAlbum($_FILES['albumArtwork'], $_POST['albumTitle'], $_POST['artist'], $_POST['genre']);

    if ($insert) {

      $data = [
        'status' => 1,
        'msg' => 'Album Created'
      ];

      echo json_encode($data);

    }else{

      $data = [
        'status' => 0,
        'msg' => 'Error to Create Album'
      ];

      echo json_encode($data);
    }
  
  }


?>