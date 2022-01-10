<?php

  include 'include/includedFiles.php'; 

  if(isset($_GET['id'])){
    $genreId = htmlspecialchars(strip_tags(trim(urldecode($_GET['id']))));

    $genre = $genre_obj->getGenreById($genreId);
  }else{
    redirect('index.php');
  }

?>

  <div class="genreHeadingContainer">
    <p>Genre</p>
    <h1 class="genreHeading"><?php echo $genre->name; ?></h1>
  </div>


  <div class="genreContainer borderBottom">

    <h2>Albums</h2>

    <?php 

      $albums = $album_obj->getAlbumsByGenre($genreId);

      if (count($albums) == 0) {
        echo "<span class='noResult'>No albums</span>";
      }else{

        foreach ($albums as $album) {

          include 'include/albumCard.php';
        };
      };

      

    ?>

  </div> <!-- end .genreContainer-->
  



  <div class="songGridViewContainer searchResult borderBottom">

    <h2>Songs</h2>

    <?php

      $songIds = $song_obj->getSongsByGenre($genreId);

      if(count($songIds) == 0){
        echo "<span class='noResult'>No songs</span>";
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

  <?php 
    include 'include/optionsMenu.php';
  ?>