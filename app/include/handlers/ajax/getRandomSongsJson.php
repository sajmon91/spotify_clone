<?php 

	include '../../init.php';

		if (!isset($_SESSION['userID']) && !isset($_SESSION['userLoggedIn'])) {

					redirect('../../../../join.php');
		}


	$songsIds = $song_obj->getRandomSongs(5);

		echo json_encode($songsIds);








?>