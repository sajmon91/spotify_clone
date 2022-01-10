<?php

  include 'include/includedFiles.php'; 

  if(isset($_GET['term'])){
    $term = htmlspecialchars(strip_tags(trim(urldecode($_GET['term']))));
  }else{
    $term = '';
  }

?>


  <div class="searchContainer">
    <h4>Search for an Song, Artist, Album, Genre or Playlist</h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing...">
  </div>

  <?php 
	
		if ($term == '') exit(); 
		
		$songIds = $song_obj->searchSong($term);

		

	?>

		<div class="songGridViewContainer searchResult borderBottom">

			<h2>Songs</h2>

			<?php

			if(count($songIds) == 0){
				echo "<span class='noResult'>No songs found matching {$term}</span>";
			}else{
			
			
			?>

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
						foreach ($songIds as $songId) {
							
							include 'include/songCard.php';

							$i++;
						}



					?>

				</ul> <!-- end .trackList-->

			<?php } // end if/else ?>

		</div><!-- end .songGridViewContainer-->


		<div class="searchResult borderBottom">

			<h2>Artists</h2>

			<?php 

				$artists = $artist_obj->searchArtist($term);

				if (count($artists) == 0) {
					echo "<span class='noResult'>No artist found matching {$term}</span>";
				}else{

					foreach ($artists as $artist) {
					
						include 'include/artistCard.php';
					};
				}

			?>

		</div> <!-- end .searchResult for artists-->


		<div class="searchResult borderBottom">

			<h2>Albums</h2>

			<?php 

				$albums = $album_obj->searchAlbums($term);

				if (count($albums) == 0) {
					echo "<span class='noResult'>No album found matching {$term}</span>";
				}else{

					foreach ($albums as $album) {

						include 'include/albumCard.php';
					};
				};

			?>

		</div> <!-- end .searchResult for albums-->


		<div class="searchResult borderBottom">

			<h2>Genre</h2>

			<?php

				$genres = $genre_obj->searchGenre($term);

				if (count($genres) == 0) {
					echo "<span class='noResult'>No genre found matching {$term}</span>";
				}else{

					foreach ($genres as $genre) {

						echo "
							<div class='genreCard'>
								
									<span role='link' tabindex='0' onclick='openPage(\"genre.php?id=" . $genre->id . "\")' class='genre'>
										{$genre->name}
									</span>
							
							</div>	
						";

					};
				};
			
			?>

		</div> <!-- end .searchResult for genre-->

	
		<div class="searchResult borderBottom">

			<h2>Playlists</h2>

			<?php 

				$playlists = $playlist_obj->searchPlaylist($term);

				if (count($playlists) == 0) {
					echo "<span class='noResult'>No playlist found matching {$term}</span>";
				}else{

					foreach ($playlists as $play){

            include 'include/playlistCard.php';
          }
					
				};

			?>


		</div> <!-- end .searchResult for playlist-->

		<?php 
            include 'include/optionsMenu.php';
         ?>