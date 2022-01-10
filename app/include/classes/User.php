<?php 

class User{
   
    private $db;

	public function __construct()
	{
	    $this->db = new Database;
	}

///////////////////////////////////////////////////////////

  public function getUsername($userId) 
  {
    $this->db->query("SELECT username FROM users WHERE id = :id");
    $this->db->bind(':id', $userId);

    $result = $this->db->single();

    return $result->username;
  }

///////////////////////////////////////////////////////////

  public function getFirstAndLastName($userId) 
  {
    $this->db->query("SELECT concat(firstName, ' ', lastName) AS name FROM users WHERE id = :id");
    $this->db->bind(':id', $userId);

    $result = $this->db->single();

    return html_entity_decode($result->name);
  }

//////////////////////////////////////////////////////////////////

  public function getProfilePicture($userId) 
  {
    $this->db->query("SELECT profilePic FROM users WHERE id = :id");
    $this->db->bind(':id', $userId);

    $result = $this->db->single();

    return $result->profilePic;
  }

//////////////////////////////////////////////////////////////////////////

  public function getEmail($userId) 
  {
    $this->db->query("SELECT email FROM users WHERE id = :id");
    $this->db->bind(':id', $userId);

    $result = $this->db->single();

    return $result->email;
  }

/////////////////////////////////////////////////////////////////////////

  public function getRole($userId) 
  {
    $this->db->query("SELECT role FROM users WHERE id = :id");
    $this->db->bind(':id', $userId);

    $result = $this->db->single();

    return $result->role;
  }

//////////////////////////////////////////////////////////////////////////

  public function updateProfilePic($userId, $files)
  {
    $user = $userId;
    $image = $files['name'];
    $image_tmp = $files['tmp_name'];

    if (move_uploaded_file($image_tmp, "../../../assets/images/profile-pics/$image")) {
      
      $this->db->query("UPDATE users SET profilePic = :img WHERE id = :userId");
      $this->db->bind(':img', $image);
      $this->db->bind(':userId', $user);

      if ($this->db->execute()) {
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

///////////////////////////////////////////////////////////////////////////

  public function validateUsername($username, $userId)
  {
    if (empty($username)) {
        return 'Username is empty';
      }

    if (strlen($username) > 25 || strlen($username) < 5) {
      return 'Your username must be between 5 and 25 characters';
    }

    if ($this->findUserByUsername($username, $userId)) {
      return 'This username already exists';
    }
  }

////////////////////////////////////////////////////////////////////////////

  private function findUserByUsername($username, $user)
  {
      $this->db->query('SELECT * FROM users WHERE username = :username AND id != :id');
      $this->db->bind(':username', $username);
      $this->db->bind(':id', $user);

      $row = $this->db->single();

      if ($this->db->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
  }

///////////////////////////////////////////////////////////////////////////////////

  public function updateUsername($username, $userId)
  {
    $this->db->query("UPDATE users SET username = :username WHERE id = :userId");
    $this->db->bind(':username', $username);
    $this->db->bind(':userId', $userId);

    if ($this->db->execute()) {
      return true;
    }else{
      return false;
    }
  }

/////////////////////////////////////////////////////////////////////////////////////

  public function validatePassword($oldPass, $newPass, $userId)
  {
    if (empty($oldPass) || empty($newPass)) {
        return 'Please fill in all fields';
    }
    
    $this->db->query("SELECT password FROM users WHERE id = :userId");
    $this->db->bind(':userId', $userId);

    $row = $this->db->single();

    if (!password_verify($oldPass, $row->password)) {
      return "Current password is incorrect";
    }

    if (strlen($newPass) < 5) {
			return "Your new password must be at least 5 characters";
		}

    if (preg_match('/[^A-Za-z0-9]/', $newPass)) {
			return "Your password can only contain numbers and letters";
		}
    
  }

/////////////////////////////////////////////////////////////////////////////////////////

  public function updatePassword($newPass, $userId)
  {
    $hash_password = password_hash($newPass, PASSWORD_BCRYPT);

    $this->db->query("UPDATE users SET password = :pass WHERE id = :userId");
    $this->db->bind(':pass', $hash_password);
    $this->db->bind(':userId', $userId);

    if ($this->db->execute()) {
      return true;
    }else{
      return false;
    }
  }

//////////////////////////////////////////////////////////////////////////////////////









} //end class





?>