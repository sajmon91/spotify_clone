<?php 

	include 'include/includedFiles.php'; 

	if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

		$playlistId = htmlspecialchars(strip_tags(trim($_GET['id'])));
		
	}else{
		redirect('index.php');
	}

  $playlist = $playlist_obj->getPlaylistById($playlistId);
  $owner = $playlist_obj->isPlaylistOwner($playlistId, $user_id);



?>

	<div class="entityInfo playlistId" data-id="<?php echo $playlistId; ?>" data-owner="<?php echo $owner; ?>">
		
		<div class="leftSection">
			<img src='assets/images/playlists-img/<?php echo $playlist_obj->getPlaylistPicture($playlistId); ?>'>

			<?php
				$playlistImage = '<div class="playlistImageInput">
														<input hidden type="file" name="playlistImg" id="playlistImg" class="playlistImage">
														<label for="playlistImg" class="playlistFile">
															<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
																<path
																	d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
															</svg> 
														</label>
												</div>';

				echo ($owner) ? $playlistImage  : '';
			?>
			
			<span class="playlistMsg"></span>
		</div>

		<div class="rightSection">
			<p>Playlist</p>
			<h2><?php echo $playlist->name; ?></h2>
			<p>
				By: <?php echo $user_obj->getUsername($playlist->userId); ?>
			</p>
			<p><?php echo $playlist_obj->getNumberOfSongs($playlistId); ?> songs, <img class="album-time" src="assets/images/icons/clock.png" alt="time"> <?php echo $playlist_obj->getPlaylistDuration($playlistId); ?></p>

      <?php
				$deletePlBtn = "<button class='deletePlaylist'>Delete Playlist</button>";
				$likePlBtn = "<button class='likePlaylist'><img class='likePlay' src=''></button>";

				echo ($owner) ? $deletePlBtn  : $likePlBtn;
      ?>

			
      
	
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

					$songIdArray = $playlist_obj->getSongsIdFromPlaylist($playlistId);

	    		$i = 1;
	    		foreach ($songIdArray as $songId) {
	    			
	    			include 'include/songCard.php';

	    			 $i++;
	    		}



	    	 ?>

	    </ul> <!-- end .trackList-->

	</div><!-- end .songGridViewContainer-->

	<nav class="optionsMenu">
		<input type="hidden" class="SongId">
		<select class='item playlistSelect'>
      	<option value=''>Add to playlist</option>
				<?php echo $playlist_obj->getPlaylistsDropdown($user_id); ?>
		</select>
		<?php
			echo ($owner) ? "<div class='item removeFromPlaylist'>Remove from playlist</div>" : "";
		?>
		<a class="item download" download>Download</a>
	</nav>






