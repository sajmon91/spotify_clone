<?php


include '../../init.php';

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if($contentType === "application/json"){

  $content = trim(file_get_contents('php://input'));

  $data = json_decode($content);

  $oldPass = htmlspecialchars(strip_tags(trim($data->oldPassword)));
  $newPass = htmlspecialchars(strip_tags(trim($data->newPassword)));


  $errorMsg = $user_obj->validatePassword($oldPass, $newPass, $data->userId);

  if (empty($errorMsg)) {

    if ($user_obj->updatePassword($newPass, $data->userId)) {
      $data = [
        'status' => 1,
        'msg' => 'Password Updated Successfully'
      ];
      echo json_encode($data);
    }else{
      $data = [
        'status' => 0,
        'msg' => 'Error To Update Password'
      ];
      echo json_encode($data);
    }
    
  }else{
    $data = [
      'status' => 0,
      'msg' => $errorMsg
    ];
    echo json_encode($data);
  }
  

}














?>