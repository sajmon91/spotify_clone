<?php


include '../../init.php';


  if (isset($_FILES['song'])) {

    $mp3file = new MP3File($_FILES['song']['tmp_name']);

    $duration = $mp3file->getDurationEstimate();

    echo json_encode($duration);

  
  }


?>