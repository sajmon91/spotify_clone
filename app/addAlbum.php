  <?php 

    include 'include/includedFiles.php'; 

    $artists = $artist_obj->getArtists();
    $genres = $genre_obj->getGenres();


  ?>

  <div class="containerGenre inputContainer">
    <h2>New Album</h2>

    <p class="artPrev">Card Preview</p>

    <div class='gridViewItem'>
      <img class="addAlbumCardImg" src=''>
     
      <div class='gridViewInfo'>
        <span class='albumName'></span>
        <span class='albumArtist'></span>
      </div>
    </div>

    

      <input type="text" class="albumTitle" name="albumTitle" placeholder="Add album title">

      <p>
        <label for="albumArtist">Artist:</label>
        <select id="albumArtist" name="albumArtist">
              <option value="">Select Artist</option>
              <?php
                foreach($artists as $artist){
                  echo "<option value='{$artist->id}'>{$artist->name}</option>";
                }
              ?>
        </select>
      </p>
      

      <p>
        <label for="albumGenre">Genre:</label>
        <select id="albumGenre" name="albumGenre">
              <option value="">Select Genre</option>
              <?php
                foreach($genres as $genre){
                  echo "<option value='{$genre->id}'>{$genre->name}</option>";
                }
              ?>
        </select>
      </p>
      

      <div>
          <input hidden type="file" name="alImg" id="alImg" class="alImg">
          <label for="alImg" class="inputFile">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
              <path
                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
            </svg> 
            <span>Choose a artwork image&hellip;</span>
          </label>
      </div>
      
      <button class="button green addButton addAlbumBtn">Save Album</button>

  
    
  </div>
