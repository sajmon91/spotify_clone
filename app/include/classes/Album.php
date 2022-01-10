<?php 


class Album
{
    private $db;

	public function __construct()
	{
	    $this->db = new Database;
	}

/////////////////////////////////////////////////////////////////////////

	public function getAlbums($limit = null)
	{
		if ($limit == null) {
			$this->db->query('SELECT * FROM albums ORDER BY rand()');
		}else{
			$this->db->query("SELECT * FROM albums ORDER BY rand() LIMIT $limit");
		}
	    
	    $result = $this->db->resultSet();
	    return $result;
	}

////////////////////////////////////////////////////////////////////////

	public function getAlbumById($albumId)
	{
	    $a_id = htmlspecialchars(strip_tags(trim($albumId)));

	    $this->db->query("SELECT * FROM albums WHERE id = :id");
	    $this->db->bind(':id', $a_id);

	    $result = $this->db->single();
	    return $result;
	}

///////////////////////////////////////////////////////////////////////

	public function getNumberOfSongs($albumId)
	{
	    $this->db->query("SELECT id FROM songs WHERE album = :id");
	    $this->db->bind(':id', $albumId);

	    $this->db->execute();

	    return $this->db->rowCount();
	}

//////////////////////////////////////////////////////////////////////

	public function getSongIds($albumId)
	{
		$array = [];

		$this->db->query("SELECT id FROM songs WHERE album = :id ORDER BY albumOrder ASC");
		$this->db->bind(':id', $albumId);

		$result = $this->db->resultSet();

		foreach ($result as $row) {
			array_push($array, $row->id);
		}

		return $array;

	}

///////////////////////////////////////////////////////////////////////

	public function searchAlbums($term)
	{
		$a_term = htmlspecialchars(strip_tags(trim($term)));

		$this->db->query("SELECT * FROM albums WHERE title LIKE :term");

		$pattern = $a_term . '%';
		$this->db->bind(':term', $pattern);

		$result = $this->db->resultSet();

		return $result;
		
	}

///////////////////////////////////////////////////////////////////

	public function getAlbumsByGenre($genreId) 
	{
		$id = htmlspecialchars(strip_tags(trim($genreId)));

		$this->db->query("SELECT * FROM albums WHERE genre = :genre");
		$this->db->bind(':genre', $id);

		$result = $this->db->resultSet();

		return $result;
	}

/////////////////////////////////////////////////////////////

	public function addNewAlbum($artwork, $title, $artist, $genre)
	{
		$image = $artwork['name'];
    $image_tmp = $artwork['tmp_name'];
		$tit = htmlspecialchars(strip_tags(trim($title)));
		$art = htmlspecialchars(strip_tags(trim($artist)));
		$gen = htmlspecialchars(strip_tags(trim($genre)));

		if (move_uploaded_file($image_tmp, "../../../assets/images/artwork/$image")) {
      
      $this->db->query("INSERT INTO albums(title, artist, genre, artworkPath) VALUES(:title, :artist, :genre, :artwork)");
      $this->db->bind(':title', $tit);
      $this->db->bind(':artist', $art);
      $this->db->bind(':genre', $gen);
      $this->db->bind(':artwork', "assets/images/artwork/{$image}");

      if ($this->db->execute()) {
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }

	}

//////////////////////////////////////////////////////////////////





} //end class

























 ?>