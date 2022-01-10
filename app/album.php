<?php 

	include 'include/includedFiles.php'; 

	if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

		$albumId = htmlspecialchars(strip_tags(trim($_GET['id'])));
		
	}else{
		redirect('index.php');
	}

	$album = $album_obj->getAlbumById($albumId);
	$artist = $artist_obj->getArtistById($album->artist);
	$genre = $genre_obj->getGenreById($album->genre);

	// getting songs id for this album
	$SArray = $album_obj->getSongIds($albumId);



?>

	<div class="entityInfo">
		
		<div class="leftSection">
			<img src="<?php echo $album->artworkPath; ?>">
		</div>

		<div class="rightSection">
			<p>Album</p>
			<h2><?php echo $album->title; ?></h2>
			<p role="link" tabindex="0">
				<img src="<?php echo $artist->artistPic; ?>" alt="">
				<span role='link' tabindex='0' onclick='openPage("artist.php?id=<?php echo $album->artist; ?>")'>
					<span><?php echo $artist->name; ?></span>
				</span>
			</p>
			<p><?php echo $album_obj->getNumberOfSongs($albumId); ?> songs, <img class="album-time" src="assets/images/icons/clock.png" alt="time"> <?php echo $song_obj->getSubDuration($albumId); ?></p>
			<p class="genre_name" onclick='openPage("genre.php?id=<?php echo $album->genre; ?>")'><?php echo $genre->name; ?></p>
		</div>

	</div>


	<div class="songGridViewContainer">

	    <div class="listInfo">
	      <span class="no">#</span>
	      <span class="ti">Title</span>
	      <span class="pl">Plays</span>
	      <span class="im">
	        <img src="assets/images/icons/clock.png" alt="time">
	      </span>
	    </div>

	    <ul class="trackList">

	    	<?php 

	    		$i = 1;
	    		foreach ($SArray as $S) {
	    			
	    			$song = $song_obj->getSongById($S);

	    			echo "
	    					<li class='tracklistRow'>
						        <div class='trackCount'>
						          <img class='plays albumPlays' data-songid = {$song->id} src='assets/images/icons/play-white.png'>
						          <span class='trackNumber'>{$i}</span>
						        </div>


						        <div class='trackInfo'>
											<span role='link' tabindex='0' onclick='openPage(\"song.php?id=" . $song->id . "\")'>
						          	<span class='trackName'>{$song->title}</span>
											</span>
											<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $song->artist . "\")'>
						          	<span class='artistName'>{$artist->name}</span>
											</span>
						        </div>

						        <div class='trackPlays'>
						          <span>{$song->plays}</span>
						        </div>

						        <div class='trackOptions'>
						          <input type='hidden' class='S' value='{$song->id}'>
						          <img class='optionsButton' src='assets/images/icons/more.png'>
						        </div>

						        <div class='trackDuration'>
						          <span class='duration'>{$song->duration}</span>
						        </div>
						      </li>
	    			 ";

	    			 $i++;
	    		}



	    	 ?>

	    </ul> <!-- end .trackList-->

	</div><!-- end .songGridViewContainer-->


	<?php 
	    include 'include/optionsMenu.php';
	?>




