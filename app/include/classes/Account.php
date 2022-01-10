<?php 

class Account{

	private $db;
	private $errorArray;

	public function __construct()
	{
	    $this->db = new Database;
	    $this->errorArray = [];
	}

////////////////////////////////////////////////////////////////////////////////////////////

	public function getError($error)
	{
		if (!in_array($error, $this->errorArray)) {	
			$error = "";
		}
		return "<span class='errorMessage'>$error</span>";
	}

///////////////////////////////////////////////////////////////////////////////////////////

	public function register($data)
	{
		$this->validateUsername($data['username']);
		$this->validateFirstName($data['firstName']);
		$this->validateLastName($data['lastName']);
		$this->validateEmail($data['email']);
		$this->validatePassword($data['password']);


		if (empty($this->errorArray)) {
			//insert into db
			return $this->insertUserDetails($data);

		}else{

			return false;
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////

	private function validateUsername($username)
	{
		if (empty($username)) {
	    	array_push($this->errorArray, Constants::$usernameEmpty);
	    	return;
	    }

		if (strlen($username) > 25 || strlen($username) < 5) {
			array_push($this->errorArray, Constants::$usernameCharacters);
			return;
		}

		if ($this->findUserByUsername($username)) {
			array_push($this->errorArray, Constants::$usernameTaken);
			return;
		}
	}

////////////////////////////////////////////////////////////////////////////////////////

		private function findUserByUsername($username)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
        	return true;
        }else{
        	return false;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////

    private function validateFirstName($fname)
    {
    	if (empty($fname)) {
	    	array_push($this->errorArray, Constants::$firstNameEmpty);
	    	return;
	    }

			if (strlen($fname) > 25 || strlen($fname) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}
    }

/////////////////////////////////////////////////////////////////////////////////////////////

    private function validateLastName($lname)
    {
      if (empty($lname)) {
	    	array_push($this->errorArray, Constants::$lastNameEmpty);
	    	return;
	    }

			if (strlen($lname) > 25 || strlen($lname) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}
    }

///////////////////////////////////////////////////////////////////////////////////////////

    private function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
        	return true;
        }else{
        	return false;
        }
    }

//////////////////////////////////////////////////////////////////////////////////////

  private function validateEmail($email)
	{
		if (empty($email)) {
			array_push($this->errorArray, Constants::$emailEmpty);
			return;
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($this->errorArray, Constants::$emailInvalid);
			return;
		}

		if ($this->findUserByEmail($email)) {
			array_push($this->errorArray, Constants::$emailTaken);
			return;
		}
	
	}

////////////////////////////////////////////////////////////////////////////////////////

	private function validatePassword($password)
	{
		if (empty($password)) {
			array_push($this->errorArray, Constants::$passwordEmpty);
			return;
		}

		if (preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($this->errorArray, Constants::$passwordNotAlphanumeris);
			return;
		}

		if (strlen($password) < 5) {
			array_push($this->errorArray, Constants::$passwordLength);
			return;
		}
	
	}

////////////////////////////////////////////////////////////////////////////////////////

	private function insertUserDetails($data)
	{
		$hash_password = password_hash($data['password'], PASSWORD_BCRYPT);
		$profilePic = "user.png";
		$date = date("Y-m-d");

		$this->db->query('INSERT INTO users (username, firstName, lastName, email, password, signUpDate, profilePic, role) VALUES(:username, :f_name, :l_name, :email, :password, :signUpDate, :profile, :role)');

		$this->db->bind(':username', $data['username']);
		$this->db->bind(':f_name', $data['firstName']);
		$this->db->bind(':l_name', $data['lastName']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $hash_password);
		$this->db->bind(':signUpDate', $date);
		$this->db->bind(':profile', $profilePic);
		$this->db->bind(':role', 'user');

		if ($this->db->execute()) {
        	return true;
        }else{
        	return false;
        }

	}

//////////////////////////////////////////////////////////////////////////////////////////

	public function login($username, $password)
	{
	    $this->validateLoginUsername($username);
	    $this->validateLoginPassword($password);

	    if (empty($this->errorArray)) {
	    	
	    	$this->db->query('SELECT * FROM users WHERE username = :username');
	    	$this->db->bind(':username', $username);

	    	$row = $this->db->single();

	    	if ($row) {
	    		$hash_password = $row->password;
	    	}else{
	    		array_push($this->errorArray, Constants::$loginFailed);
					return false;
	    	}
	    	

	    	if (password_verify($password, $hash_password)) {
	    		$data = [
	    			'user_id' => $row->id,
	    			'username' => $row->username,
						'user_img' => $row->profilePic
	    		];

	    		return $data;
	    	}else{
	    		array_push($this->errorArray, Constants::$loginFailed);
				return false;
	    	}
	    }
	}

///////////////////////////////////////////////////////////////////////////////////////////

	private function validateLoginUsername($username)
	{
	    if (empty($username)) {
			array_push($this->errorArray, Constants::$usernameEmpty);
			return;
		}
	}

////////////////////////////////////////////////////////////////////////////////////////

	private function validateLoginPassword($password)
	{
	    if (empty($password)) {
			array_push($this->errorArray, Constants::$passwordEmpty);
			return;
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////









    
} // end class




















 ?>