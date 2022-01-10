<?php 

class Song{
   
    private $db;

	public function __construct()
	{
	    $this->db = new Database;
	}

///////////////////////////////////////////////////////////

	public function getSongById($songId)
	{
	    $s_id = htmlspecialchars(strip_tags(trim($songId)));

	    $this->db->query("SELECT * FROM songs WHERE id = :id");
	    $this->db->bind(':id', $s_id);

	    $result = $this->db->single();
	    return $result;
	}

///////////////////////////////////////////////////////////

	public function getSubDuration($albumId)
	{
	    $this->db->query("SELECT duration FROM songs WHERE album = :id");
	    $this->db->bind(':id', $albumId);

	    $result = $this->db->resultSet();

			$numbers = array_map(function($el){
					return $el->duration;
			}, $result);


			return durationFormat($numbers);

	}

////////////////////////////////////////////////////////////

	public function getRandomSongs($limit = null)
	{
		if ($limit == null) {
			$this->db->query("SELECT id FROM songs ORDER BY rand()");
		}else{
			$this->db->query("SELECT id FROM songs ORDER BY rand() LIMIT $limit");
		}
	    

	    $result = $this->db->resultSet();

	    $songs = array_map(function($el){
	    	return $el->id;
	    }, $result);

	    return $songs;
	}

//////////////////////////////////////////////////////////////////

	public function updatePlays($songId)
	{
		$s_id = htmlspecialchars(strip_tags(trim($songId)));

		$this->db->query("UPDATE songs SET plays = plays + 1 WHERE id = :id");
		$this->db->bind(':id', $s_id);
		$this->db->execute();
	}

////////////////////////////////////////////////////////////////////

	public function searchSong($term)
	{
		$s_term = htmlspecialchars(strip_tags(trim($term)));

		$this->db->query("SELECT id FROM songs WHERE title LIKE :term");

		$pattern = $s_term . '%';
		$this->db->bind(':term', $pattern);

		$result = $this->db->resultSet();
		
		$songsId = array_map(function($el){
			return $el->id;
		}, $result);

		return $songsId;
	}

///////////////////////////////////////////////////////////////////////////

	public function getSongsByGenre($genreId)
	{
		$id = htmlspecialchars(strip_tags(trim($genreId)));

		$this->db->query("SELECT id FROM songs WHERE genre = :genre");
		$this->db->bind(':genre', $id);

		$result = $this->db->resultSet();
		
		$songsId = array_map(function($el){
			return $el->id;
		}, $result);

		return $songsId;
	}

///////////////////////////////////////////////////////////////////////////

	public function addNewSong($fileSong, $title, $artist, $album, $genre, $duration, $youtube)
	{
		$song = $fileSong['name'];
		$song_tmp = $fileSong['tmp_name'];
		$tit = htmlspecialchars(strip_tags(trim($title)));
		$art = htmlspecialchars(strip_tags(trim($artist)));
		$alb = htmlspecialchars(strip_tags(trim($album)));
		$gen = htmlspecialchars(strip_tags(trim($genre)));
		$dur = htmlspecialchars(strip_tags(trim($duration)));

		

		$link = !$youtube == '' ? explode("&", $youtube) : '';

		$linkValue = !$link == '' ? preg_replace("!watch\?v=!", "embed/", $link[0]) : '';



		$this->db->query("SELECT MAX(albumOrder) + 1 AS albumOrder FROM songs WHERE album = :al_id");
		$this->db->bind(':al_id', $alb);
		$single = $this->db->single();
		$order = $single->albumOrder;

		if($order != ""){
			$order = $single->albumOrder;
		}else{
			$order = $single->albumOrder + 1;
		}



		if (move_uploaded_file($song_tmp, "../../../assets/music/$song")) {
			
			$this->db->query("INSERT INTO songs(title, artist, album, genre, duration, path, albumOrder, plays, video) VALUES(:title, :artist, :album, :genre, :duration, :path, :albumOrder, :plays, :video)");

			$this->db->bind(':title', $tit);
			$this->db->bind(':artist', $art);
			$this->db->bind(':album', $alb);
			$this->db->bind(':genre', $gen);
			$this->db->bind(':duration', $dur);
			$this->db->bind(':path', "assets/music/{$song}");
			$this->db->bind(':albumOrder', $order);
			$this->db->bind(':plays', 0);
			$this->db->bind(':video', $linkValue);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}

////////////////////////////////////////////////////////////////////////////////








} //end class





?>