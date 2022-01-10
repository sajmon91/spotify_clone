<?php 

class Likes{
   
  private $db;

	public function __construct()
	{
	    $this->db = new Database;
	}

///////////////////////////////////////////////////////////

	public function checkLikeSong($songId, $userId)
	{
	    $s_id = htmlspecialchars(strip_tags(trim($songId)));
	    $u_id = htmlspecialchars(strip_tags(trim($userId)));


	    $this->db->query("SELECT * FROM likedsongs WHERE id_user = :us_id AND id_song = :so_id");
	    $this->db->bind(':us_id', $u_id);
	    $this->db->bind(':so_id', $s_id);


	    $result = $this->db->single();

	    if ($this->db->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
	}

///////////////////////////////////////////////////////////

  public function likeSong($songId, $userId)
  {
    $s_id = htmlspecialchars(strip_tags(trim($songId)));
	  $u_id = htmlspecialchars(strip_tags(trim($userId)));

		$this->db->query("SELECT count(id) AS total FROM likedsongs WHERE id_user = :us AND id_song = :so");
		$this->db->bind(':us', $u_id);
    $this->db->bind(':so', $s_id);

		$result = $this->db->single();
		
		if(!$result->total > 0){

			$this->db->query("INSERT INTO likedsongs(id_user, id_song) VALUES(:user, :song)");

			$this->db->bind(':user', $u_id);
			$this->db->bind(':song', $s_id);

			$this->db->execute();
		}

  }

///////////////////////////////////////////////////////////////

	public function dislikeSong($songId, $userId)
	{
		$s_id = htmlspecialchars(strip_tags(trim($songId)));
		$u_id = htmlspecialchars(strip_tags(trim($userId)));


		$this->db->query("DELETE FROM likedsongs WHERE id_user = :user AND id_song = :song");

		$this->db->bind(':user', $u_id);
		$this->db->bind(':song', $s_id);

		$this->db->execute();
	
	}

////////////////////////////////////////////////////////////////////

	public function checkLikePlaylist($playlistId, $userId)
	{
			$p_id = htmlspecialchars(strip_tags(trim($playlistId)));
			$u_id = htmlspecialchars(strip_tags(trim($userId)));


			$this->db->query("SELECT * FROM likedplaylists WHERE userId = :us_id AND playlistId = :pl_id");
			$this->db->bind(':us_id', $u_id);
			$this->db->bind(':pl_id', $p_id);


			$result = $this->db->single();

			if ($this->db->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
	}

////////////////////////////////////////////////////////////////////////

	public function likePlaylist($playlistId, $userId)
	{
		$p_id = htmlspecialchars(strip_tags(trim($playlistId)));
		$u_id = htmlspecialchars(strip_tags(trim($userId)));

		$this->db->query("INSERT INTO likedplaylists(userId, playlistId) VALUES(:user, :playlist)");

		$this->db->bind(':user', $u_id);
		$this->db->bind(':playlist', $p_id);

		$this->db->execute();
	}

//////////////////////////////////////////////////////////////////////////

	public function dislikePlaylist($playlistId, $userId)
	{
		$p_id = htmlspecialchars(strip_tags(trim($playlistId)));
		$u_id = htmlspecialchars(strip_tags(trim($userId)));


		$this->db->query("DELETE FROM likedplaylists WHERE userId = :user AND playlistId = :playlist");

		$this->db->bind(':user', $u_id);
		$this->db->bind(':playlist', $p_id);

		$this->db->execute();
	}

///////////////////////////////////////////////////////////////////////////

	public function likedSongs($userId)
	{
		$this->db->query("SELECT id_song, dateLiked FROM likedsongs WHERE id_user = :id ORDER BY dateLiked DESC");
		$this->db->bind(':id', $userId);

		$result = $this->db->resultSet();

		return $result;
	}

////////////////////////////////////////////////////////////////////////////////

	public function getNumberOfSongs($userId)
	{
			$this->db->query("SELECT id FROM likedsongs WHERE id_user = :id");
			$this->db->bind(':id', $userId);

			$this->db->execute();

			return $this->db->rowCount();
	}

////////////////////////////////////////////////////////////////////////////

	public function getLikedSongsDuration($userId)
	{
			$this->db->query("SELECT s.id, s.duration FROM songs AS s INNER JOIN likedsongs AS ls ON s.id = ls.id_song WHERE ls.id_user = :id");
			$this->db->bind(':id', $userId);

			$result = $this->db->resultSet();

			$numbers = array_map(function($el){
					return $el->duration;
			}, $result);


		return durationFormat($numbers);

	}

/////////////////////////////////////////////////////////////////////////////////










} //end class





?>