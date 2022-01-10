<?php 


function redirect($location){

	header("Location: $location");
}

///////////////////////////////////////////////////////////////////

function set_message($msg){

	if (!empty($msg)) {
		
		$_SESSION['message'] = $msg;

	}else{

		$msg = "";
	}
}

////////////////////////////////////////////////////////////////////

function display_message(){

	if (isset($_SESSION['message'])) {
		
		echo $_SESSION['message'];

		unset($_SESSION['message']);
	}
}

/////////////////////////////////////////////////////////////////////

function getInputValue($name){
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}

////////////////////////////////////////////////////////////////////

function isLoggedIn(){

    if (isset($_SESSION['user_id'])) {
    	return true;
    }else{
    	return false;
    }
}

///////////////////////////////////////////////////////////////////////

function isAdmin(){

	if (isLoggedIn()) {
		
		if ($_SESSION['role'] === 'admin') {
			return true;
		}else{
			return false;
		}
	}
}

///////////////////////////////////////////////////////////////////////

function durationFormat($array){

	$min_arr = [];
	$sec_arr = [];
	foreach ($array as $number){
		
		[$min, $sec] = explode(":", $number);
		array_push($min_arr, $min);
		array_push($sec_arr, $sec);
	};

	$min = array_sum($min_arr);
	$min = $min * 60;
	$sec = array_sum($sec_arr);
	$uk = $min + $sec;

	return gmdate("H:i:s", $uk);
}

////////////////////////////////////////////////////////////////////////////////


 ?>