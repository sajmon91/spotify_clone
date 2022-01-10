<?php


include '../../init.php';

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if($contentType === "application/json"){

  $content = trim(file_get_contents('php://input'));

  $data = json_decode($content);

  $userName = htmlspecialchars(strip_tags(trim($data->username)));


  $errorMsg = $user_obj->validateUsername($userName, $data->userId);

  if (empty($errorMsg)) {

    if ($user_obj->updateUsername($userName, $data->userId)) {
      $data = [
        'status' => 1,
        'msg' => 'Username Updated Successfully',
        'username' => $userName
      ];
      echo json_encode($data);
    }else{
      $data = [
        'status' => 0,
        'msg' => 'Error To Update Username'
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