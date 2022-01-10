  <?php 

    include 'include/includedFiles.php'; 

  ?>

  <div class="containerGenre borderBottom">
    <h2>New Genre</h2>
    <input type="text" class="genre" name="genre" placeholder="Add new genre name">

    <button class="button green addButton addGenreBtn">Add Genre</button>
  </div>

  <?php

    $genres = $genre_obj->getGenres();

    foreach ($genres as $genre) {

      echo "<div class='genreCard'>
									<span role='link' tabindex='0' onclick='openPage(\"genre.php?id=" . $genre->id . "\")' class='genre'>
										{$genre->name}
									</span>
						</div>";

    }
  
  
  
  ?>