<?php 


class Artist
{
  private $db;

	public function __construct()
	{
	    $this->db = new Database;
	}

/////////////////////////////////////////////////////////////////////////

	public function getArtistById($artist_id)
	{
		$u_id = htmlspecialchars(strip_tags(trim($artist_id)));
		
	    $this->db->query('SELECT * FROM artists WHERE id = :id');
	    $this->db->bind(':id', $u_id);

	    $result = $this->db->single();
	    return $result;
	}

////////////////////////////////////////////////////////////////////////

	public function getArtists($limit = null)
	{
		if ($limit == null) {
			$this->db->query("SELECT * FROM artists ORDER BY rand()");
		}else{
			$this->db->query("SELECT * FROM artists ORDER BY rand() LIMIT $limit");
		}
	    
	    $result = $this->db->resultSet();
	    return $result;
	}

////////////////////////////////////////////////////////////////////////

	public function getSongsFromArtistId($artistId) 
	{
			$this->db->query("SELECT * FROM songs WHERE artist = :id ORDER BY plays DESC LIMIT 10");
			$this->db->bind(':id', $artistId);

			$result = $this->db->resultSet();
			return $result;
	}

	/////////////////////////////////////////////////////////////////////////

	public function getAlbumsFromArtistId($artistId)
	{
			$this->db->query("SELECT * FROM albums WHERE artist = :id");
			$this->db->bind(':id', $artistId);

			$result = $this->db->resultSet();
			return $result;
	}

////////////////////////////////////////////////////////////////////////////

	public function countSongsFromArtist($artistId)
	{
		$this->db->query("SELECT count(id) AS total FROM songs WHERE artist = :id");
		$this->db->bind(':id', $artistId);

		$result = $this->db->single();
		return $result;
	}

////////////////////////////////////////////////////////////////////////

	public function countAlbumsFromArtist($artistId)
	{
		$this->db->query("SELECT count(id) AS total FROM albums WHERE artist = :id");
		$this->db->bind(':id', $artistId);

		$result = $this->db->single();
		return $result;
	}

//////////////////////////////////////////////////////////////////////////

	public function searchArtist($term)
	{
		$a_term = htmlspecialchars(strip_tags(trim($term)));

		$this->db->query("SELECT * FROM artists WHERE name LIKE :term");

		$pattern = $a_term . '%';
		$this->db->bind(':term', $pattern);

		$result = $this->db->resultSet();

		return $result;
	}

//////////////////////////////////////////////////////////////////////////////

	public function addNewArtist($img, $artist)
	{
		$image = $img['name'];
    $image_tmp = $img['tmp_name'];
		$ar = htmlspecialchars(strip_tags(trim($artist)));

		if (move_uploaded_file($image_tmp, "../../../assets/images/artists/$image")) {
      
      $this->db->query("INSERT INTO artists(name, artistPic) VALUES(:artist, :img)");
      $this->db->bind(':artist', $ar);
      $this->db->bind(':img', "assets/images/artists/{$image}");

      if ($this->db->execute()) {
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }

	}

////////////////////////////////////////////////////////////////////////////






} //end class


























 ?>