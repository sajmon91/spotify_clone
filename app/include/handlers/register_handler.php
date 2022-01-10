<?php 

function sanitizeFormUsername($inputText){
	$inputText = htmlspecialchars(strip_tags($inputText));
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}


function sanitizeFormString($inputText){
	$inputText = htmlspecialchars(strip_tags($inputText));
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(mb_strtolower($inputText, 'UTF-8'));
	return $inputText;
}


function sanitizeFormEmail($inputText){
	$inputText = htmlspecialchars(strip_tags($inputText));
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}


function sanitizeFormPassword($inputText){
	$inputText = htmlspecialchars(strip_tags($inputText));
	return $inputText;
}

if (isset($_POST['registerButton'])) {

	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email = sanitizeFormEmail($_POST['email']);
	$password = sanitizeFormPassword($_POST['password']);

	$data = [
		'username' => $username,
		'firstName' => $firstName,
		'lastName' => $lastName,
		'email' => $email,
		'password' => $password
	];

	 $wasSuccessful = $account->register($data);

	if ($wasSuccessful) {
		
		set_message("<p class='text-center'>You are registered and can log in</p>");
		redirect('join.php');
	};
	
}












 ?>