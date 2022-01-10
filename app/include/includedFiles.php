<?php


  if(isset($_SERVER['HTTP_X_CUSTOM_HEADER'])){
   
    include 'init.php';

    if (isset($_SESSION['userID'])) {
      $user_id = $_SESSION['userID'];
    }

  }else{
    include 'include/header.php';
    include 'include/footer.php';

    $url = $_SERVER['REQUEST_URI'];
    echo "<script>openPage('$url')</script>";

    exit();
  }



?>