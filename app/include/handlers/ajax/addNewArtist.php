<?php


include '../../init.php';


  if (isset($_FILES['artistImage']) && isset($_POST['artistName'])) {

    $insert = $artist_obj->addNewArtist($_FILES['artistImage'], $_POST['artistName']);

    if ($insert) {

      $data = [
        'status' => 1,
        'msg' => 'Artist Created'
      ];

      echo json_encode($data);

    }else{

      $data = [
        'status' => 0,
        'msg' => 'Error to Create Artist'
      ];

      echo json_encode($data);
    }
  
  }


?>