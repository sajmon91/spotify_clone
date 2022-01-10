<?php 

	include 'include/includedFiles.php'; 

	if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

		$songId = htmlspecialchars(strip_tags(trim($_GET['id'])));
		
	}else{
		redirect('index.php');
	}

  $song = $song_obj->getSongById($songId);

	$album = $album_obj->getAlbumById($song->album);
	$artist = $artist_obj->getArtistById($song->artist);
	$genre = $genre_obj->getGenreById($song->genre);




?>

	<div class="entityInfo songEntity borderBottom">
		
		<div class="leftSection">
			<img src="<?php echo $album->artworkPath; ?>">
		</div>

		<div class="rightSection">
			<p>Song</p>
			<h2><?php echo $song->title; ?>
      	<button class="button green" onclick="songPagePlay(<?php echo $songId; ?>)"><img src="assets/images/icons/play-white.png" alt="Play Button"></button>
      </h2>
      <p>Album: 
        <span role='link' tabindex='0' onclick='openPage("album.php?id=<?php echo $song->album; ?>")'>
					<span><?php echo $album->title; ?></span>
				</span>
      </p>
			<p role="link" tabindex="0">
        Artist: 
				<img src="<?php echo $artist->artistPic; ?>" alt="">
				<span role='link' tabindex='0' onclick='openPage("artist.php?id=<?php echo $song->artist; ?>")'>
					<span><?php echo $artist->name; ?></span>
				</span>
			</p>
			<p>Genre: <span onclick='openPage("genre.php?id=<?php echo $song->genre; ?>")'><?php echo $genre->name; ?></span></p>
		</div>

	</div>


  <div class="songViewContainer ">

    <?php 

      if(empty($song->video)){
        echo "<h2>No Available Video</h2>";
      }else{

    ?>

			<h2>Music video:</h2>

			<div class="videoContainer">
				<iframe width="100%" height="100%" src="<?php echo $song->video; ?>" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
			</div>

    <?php } ?>
  </div> <!-- end .gridViewContainer-->


	







