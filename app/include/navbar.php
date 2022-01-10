
 		<!-- left bar -->
	      <div id="navBarContainer">
	        <nav class="navBar">

	          <span role="link" tabindex="0" class="logo">
	            <img src="assets/images/icons/logo.png" alt="logo" title="Simonfy">
	          </span>

	          <div class="group">
	            <div class="navItem">
	              <span role="link" tabindex="0" class="navItemLink homeLink">Home
	                <img src="assets/images/icons/home.png" alt="home" class="icon">
	              </span>
	            </div>
	          </div>

	          <div class="group">
	            <div class="navItem">
	              <span role="link" tabindex="0" class="navItemLink searchLink">Search
	                <img src="assets/images/icons/search.png" alt="search" class="icon">
	              </span>
	            </div>
	          </div>

	          <div class="group">

	            <div class="navItem">
	              <span role="link" tabindex="0" class="navItemLink playlistLink">Playlists
	                <img src="assets/images/icons/your_playlist.png" alt="playlist" class="icon">
	              </span>
	            </div>

	            <div class="navItem">
	              <span role="link" tabindex="0" class="navItemLink songsLink">Liked Songs
	                <img src="assets/images/icons/heart_nav.png" alt="Liked songs" class="icon">
	              </span>
	            </div>
	          </div>

						<?php if ($user_obj->getRole($user_id) == 'admin'):?>

							<div class="group">

								<div class="navItem">
									<span role="link" tabindex="0" class="navItemLink addArtistLink">Add Artist</span>
								</div>

								<div class="navItem">
									<span role="link" tabindex="0" class="navItemLink addGenreLink">Add Genre</span>
								</div>

								<div class="navItem">
									<span role="link" tabindex="0" class="navItemLink addAlbumLink">Add Album</span>
								</div>

								<div class="navItem">
									<span role="link" tabindex="0" class="navItemLink addSongLink">Add Song</span>
								</div>
								
							</div>

						<?php endif; ?>

	        </nav>
	      </div> <!-- end #navBarContainer-->

	      <!-- mobile nav -->
	      <div id="mobNav">
	        <div class="container">
						
	          <div class="mobItem active">
	            <span role="link" tabindex="0" class="mobItemLink homeLink">
	              <img src="assets/images/icons/home.png" alt="home" class="mob-icon">
	            </span>
	          </div>

	          <div class="mobItem">
	            <span role="link" tabindex="0" class="mobItemLink searchLink">
	              <img src="assets/images/icons/search.png" alt="search" class="mob-icon">
	            </span>
	          </div>

	          <div class="mobItem">
	            <span role="link" tabindex="0" class="mobItemLink playlistLink">
	              <img src="assets/images/icons/your_playlist.png" alt="playlist" class="mob-icon">
	            </span>
	          </div>

	          <div class="mobItem">
	            <span role="link" tabindex="0" class="mobItemLink songsLink">
	              <img src="assets/images/icons/heart_nav.png" alt="liked" class="mob-icon">
	            </span>
	          </div>

	        </div>
	      </div> <!-- end #mobNav-->

	      <div id="topBar">
	        <span role="link" tabindex="0" class="mobLogo">
	          <img src="assets/images/icons/logo.png" alt="logo" title="Simonfy">
	        </span>
	        
	        <div class="content">

	          <div class="profilePic">
	            <img src='assets/images/profile-pics/<?php echo $user_obj->getProfilePicture($user_id); ?>' alt="profile image">
	          </div>



	          <div class="dropdown">
	            <button class="dropbtn">
	             	<span><?php echo $userLoggedIn; ?></span> <i class="arrow down"></i>
	            </button>

	            <div id="drop" class="dropdown-content">
	              <span class="profile">Profile</span>
	              <span class="logout">Logout</span>
	            </div>
	          </div>

	        </div>
	      </div> <!-- end #topBar-->