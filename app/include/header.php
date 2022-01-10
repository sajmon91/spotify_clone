
<?php 
    
    include 'init.php'; 

    if (isset($_SESSION['userID'])) {
        $user_id = $_SESSION['userID'];
        $userLoggedIn = $user_obj->getUsername($user_id);
        $userRole = $user_obj->getRole($user_id);


        echo "<script>
                  const userLoggedInId = $user_id;
                  const userRole = '$userRole';
              </script>";

    }else{
      redirect('../join.php');
    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="assets/images/icons/logo.png">
  <link href="assets/css/style.css" rel="stylesheet">
  <title>Welcome to Simonfy</title>
</head>

<body>

  <div id="mainContainer">

    <div id="topContainer">

      <?php include 'navbar.php'; ?>

       <div id="mainViewContainer">
        <div id="mainContent">

