<?php


include '../../init.php';


  if (isset($_FILES['playlistImage']) && isset($_POST['playlistId'])) {


    $update = $playlist_obj->updatePlaylistPic($_POST['playlistId'], $_FILES['playlistImage']);

    if ($update) {

      $data = [
        'status' => 1,
        'image' => $_FILES['playlistImage']['name']
      ];

      echo json_encode($data);

    }else{

      $data = [
        'status' => 0,
        'msg' => 'Error Image No Uploaded'
      ];

      echo json_encode($data);
    }
  
  }

 
















?>