<?php 

class Genre{
   
    private $db;

	public function __construct()
	{
	    $this->db = new Database;
	}

///////////////////////////////////////////////////////////

	public function getGenreById($genre_id)
	{
	    $g_id = htmlspecialchars(strip_tags(trim($genre_id)));

	    $this->db->query("SELECT * FROM genres WHERE id = :id");
	    $this->db->bind(':id', $g_id);

	    $result = $this->db->single();
	    return $result;
	}

///////////////////////////////////////////////////////////

	public function searchGenre($term)
	{
		$g_term = htmlspecialchars(strip_tags(trim($term)));

		$this->db->query("SELECT * FROM genres WHERE name LIKE :term");

		$pattern = $g_term . '%';
		$this->db->bind(':term', $pattern);

		$result = $this->db->resultSet();

		return $result;
	}

//////////////////////////////////////////////////////////////////

	public function getGenres()
	{
		$this->db->query("SELECT * FROM genres ORDER BY id DESC");

		$result = $this->db->resultSet();

		return $result;
	}

///////////////////////////////////////////////////////////////////////

	public function addGenre($genre)
	{
		$g = htmlspecialchars(strip_tags(trim($genre)));

		$this->db->query("INSERT INTO genres(name) VALUES(:genre)");
		$this->db->bind(':genre', $g);

		$this->db->execute();
	}

//////////////////////////////////////////////////////////////////





} //end class





?>