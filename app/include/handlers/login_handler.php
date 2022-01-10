<?php 


function sanitizeLoginFormUsername($inputText){
	$inputText = htmlspecialchars(strip_tags($inputText));
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}


function sanitizeLoginFormPassword($inputText){
	$inputText = htmlspecialchars(strip_tags($inputText));
	return $inputText;
}


if (isset($_POST['loginButton'])) {
	
	$username = sanitizeLoginFormUsername($_POST['loginUsername']);
	$password = sanitizeLoginFormPassword($_POST['loginPassword']);

	$result = $account->login($username, $password);

	if ($result) {
		
		$_SESSION['userID'] = $result['user_id'];

		redirect('app/index.php');
	}
}









 ?>