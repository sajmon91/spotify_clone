<?php 

class Playlist{
   
    private $db;

	public function __construct()
	{
	    $this->db = new Database;
	}

///////////////////////////////////////////////////////////

	public function insertPlaylist($playlistName, $userId)
	{
	    $playlist = htmlspecialchars(strip_tags(trim($playlistName)));
	    $user = htmlspecialchars(strip_tags(trim($userId)));
      $date = date('Y-m-d');

	    $this->db->query("INSERT INTO playlists(name, userId, dateCreated) VALUES (:playlist, :user, :dateCreated)");
	    $this->db->bind(':playlist', $playlist);
	    $this->db->bind(':user', $user);
	    $this->db->bind(':dateCreated', $date);

      $this->db->execute();
	}

///////////////////////////////////////////////////////////

  public function getPlaylistByUser($userId) 
  {
    $id = htmlspecialchars(strip_tags(trim($userId)));

    $this->db->query("SELECT * FROM playlists WHERE userId = :id");
    $this->db->bind(':id', $id);

    $result = $this->db->resultSet();

    return $result;
  }

//////////////////////////////////////////////////////////////////

  public function getPlaylistPicture($playlistId) 
  {
    $this->db->query("SELECT playlistImg FROM playlists WHERE id = :id");
    $this->db->bind(':id', $playlistId);

    $result = $this->db->single();

    return $result->playlistImg;
  }

//////////////////////////////////////////////////////////////////

  public function getPlaylists($limit = null)
  {
    if ($limit == null) {
      $this->db->query('SELECT * FROM playlists ORDER BY rand()');
    }else{
      $this->db->query("SELECT * FROM playlists ORDER BY rand() LIMIT $limit");
    }
    
    $result = $this->db->resultSet();
    return $result;
  }

////////////////////////////////////////////////////////////////

  public function searchPlaylist($term)
  {
    $p_term = htmlspecialchars(strip_tags(trim($term)));

    $this->db->query("SELECT * FROM playlists WHERE name LIKE :term");

    $pattern = $p_term . '%';
    $this->db->bind(':term', $pattern);

    $result = $this->db->resultSet();

    return $result;
  }

/////////////////////////////////////////////////////////////////////

  public function isPlaylistOwner($playlistId, $userId) 
  {
    $this->db->query("SELECT id FROM playlists WHERE id = :playlist AND userId = :user");
    $this->db->bind(':playlist', $playlistId);
    $this->db->bind(':user', $userId);

    $this->db->execute();

    if ($this->db->rowCount() > 0) {
      return true;
    }else{
      return false;
    }
  }

//////////////////////////////////////////////////////////////////////

  public function getPlaylistById($playlistId) 
  {
    $this->db->query("SELECT * FROM playlists WHERE id = :id");
    $this->db->bind(':id', $playlistId);

    $result = $this->db->single();

    return $result;
  }

/////////////////////////////////////////////////////////////////////

  public function getNumberOfSongs($playlistId)
  {
      $this->db->query("SELECT songId FROM playlistsongs WHERE playlistId = :id");
      $this->db->bind(':id', $playlistId);

      $this->db->execute();

      return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////

  public function getPlaylistDuration($playlistId)
  {
      $this->db->query("SELECT s.id, s.duration FROM songs AS s INNER JOIN playlistsongs AS ps ON s.id = ps.songId WHERE ps.playlistId = :id");
      $this->db->bind(':id', $playlistId);

      $result = $this->db->resultSet();

      $numbers = array_map(function($el){
          return $el->duration;
      }, $result);


      return durationFormat($numbers);

  }

////////////////////////////////////////////////////////////////////

  public function getSongsIdFromPlaylist($playlistId) 
  {
    $this->db->query("SELECT songId, playlistOrder FROM playlistsongs WHERE playlistId = :id ORDER BY playlistOrder ASC");
    $this->db->bind(':id', $playlistId);

    $result = $this->db->resultSet();

    $ids = array_map(function($el){
        return $el->songId;
    }, $result);

    return $ids;
  }

////////////////////////////////////////////////////////////////////

  public function deletePlaylist($playlistId)
  {
      $playlist = htmlspecialchars(strip_tags(trim($playlistId)));

      $this->db->query("DELETE FROM playlists WHERE id = :id");
      $this->db->bind(':id', $playlist);
      
      if ($this->db->execute()) {
        $this->db->query("DELETE FROM playlistsongs WHERE playlistId = :pId");
        $this->db->bind(':pId', $playlist);
        $this->db->execute();
      }
      
  }

//////////////////////////////////////////////////////////////////////

  public function getLikedPlaylist($user_id)
  {
    $this->db->query("SELECT p.id, p.name, p.userId, p.playlistImg FROM playlists AS p INNER JOIN likedplaylists AS lp ON p.id = lp.playlistId WHERE lp.userId = :id");
    $this->db->bind(':id', $user_id);

    $result = $this->db->resultSet();
    return $result;
  }

/////////////////////////////////////////////////////////////////////////

  public function getPlaylistsDropdown($user_id)
  {
    $this->db->query("SELECT id, name FROM playlists WHERE userId = :id");
    $this->db->bind(':id', $user_id);
    $result = $this->db->resultSet();

    foreach ($result as $row) {
      $dropdown = $dropdown . "<option value='{$row->id}'>{$row->name}</option>";
    }

    return $dropdown;
  }

////////////////////////////////////////////////////////////////////////

  public function insertToPlaylist($playlistId, $songId)
  {
      $playlist = htmlspecialchars(strip_tags(trim($playlistId)));
      $song = htmlspecialchars(strip_tags(trim($songId)));

      $this->db->query("SELECT count(id) AS total FROM playlistsongs WHERE songId = :so AND playlistId = :pl");
      $this->db->bind(':so', $song);
      $this->db->bind(':pl', $playlist);

      $result = $this->db->single();

      if (!$result->total > 0) {
        $this->db->query("SELECT MAX(playlistOrder) + 1 AS playlistOrder FROM playlistsongs WHERE playlistId = :p_id");
        $this->db->bind(':p_id', $playlist);
        $single = $this->db->single();
        $order = $single->playlistOrder;

        if($order != ""){
          $order = $single->playlistOrder;
        }else{
          $order = $single->playlistOrder + 1;
        }
        

        $this->db->query("INSERT INTO playlistsongs(songId, playlistId, playlistOrder) VALUES (:song, :playlist, :playlistOrder)");
        $this->db->bind(':song', $song);
        $this->db->bind(':playlist', $playlist);
        $this->db->bind(':playlistOrder', $order);

        $this->db->execute();
      };
  }

//////////////////////////////////////////////////////////////////

  public function removeFromPlaylist($playlistId, $songId)
  {
      $playlist = htmlspecialchars(strip_tags(trim($playlistId)));
      $song = htmlspecialchars(strip_tags(trim($songId)));

      $this->db->query("DELETE FROM playlistsongs WHERE playlistId = :playlist AND songId = :song");
      $this->db->bind(':playlist', $playlist);
      $this->db->bind(':song', $song);
      
      $this->db->execute();
  }

//////////////////////////////////////////////////////////////////////////

  public function updatePlaylistPic($playlistId, $files)
  {
    $image = $files['name'];
    $image_tmp = $files['tmp_name'];

    if (move_uploaded_file($image_tmp, "../../../assets/images/playlists-img/$image")) {
      
      $this->db->query("UPDATE playlists SET playlistImg = :img WHERE id = :playlistId");
      $this->db->bind(':img', $image);
      $this->db->bind(':playlistId', $playlistId);

      if ($this->db->execute()) {
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

/////////////////////////////////////////////////////////////////////////












} //end class





?>