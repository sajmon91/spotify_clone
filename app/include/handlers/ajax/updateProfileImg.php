<?php


include '../../init.php';


  if (isset($_FILES['image']) && isset($_POST['userId'])) {

    $update = $user_obj->updateProfilePic($_POST['userId'], $_FILES['image']);

    if ($update) {

      $data = [
        'status' => 1,
        'msg' => 'Image Uploaded Successfully',
        'image' => $_FILES['image']['name']
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