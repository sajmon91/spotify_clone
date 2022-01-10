<?php


include '../../init.php';


  if (isset($_FILES['song']) && isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['album']) && isset($_POST['genre']) && isset($_POST['duration'])) {

    $link = isset($_POST['youtube']) ? $_POST['youtube'] : '';


    $insert = $song_obj->addNewSong($_FILES['song'], $_POST['title'], $_POST['artist'], $_POST['album'], $_POST['genre'], $_POST['duration'], $link);

    if ($insert) {

      $data = [
        'status' => 1,
        'msg' => 'Song Created'
      ];

      echo json_encode($data);

    }else{

      $data = [
        'status' => 0,
        'msg' => 'Error to Create Song'
      ];

      echo json_encode($data);
    }
  
  }


?>