
    <!-- playing bar -->
    <div id="nowPlayingBarContainer">

      <div id="nowPlayingBar">

        <div id="nowPlayingLeft">
          <div class="content">
            <span class="albumLink">
              <img role="link" tabindex="0" src="" alt="music" class="albumArtwork albumLinkId">
            </span>

            <div class="trackInfo">
              <span class="trackName">
                <span class="albumLinkId" role="link" tabindex="0"></span>
              </span>

              <span class="artistName">
                <span class="artistLinkId" role="link" tabindex="0"></span>
              </span>
            </div>


            <button class="controlButton likeSong">
              <img src="" alt="Liked songs" class="like-icon">
            </button>

          </div>
        </div>

        <div id="nowPlayingCenter">

          <div class="content playerControls">

            <div class="buttons">

              <button class="controlButton shuffle" title="Shuffle button">
                <img src="assets/images/icons/shuffle.png" alt="shuffle">
              </button>

              <button class="controlButton previous" title="Previous button">
                <img src="assets/images/icons/previous.png" alt="previous">
              </button>

              <button class="controlButton play" title="Play button">
                <img src="assets/images/icons/play.png" alt="play">
              </button>

              <button class="controlButton pause" title="Pause button" style="display: none;">
                <img src="assets/images/icons/pause.png" alt="pause">
              </button>

              <button class="controlButton next" title="Next button">
                <img src="assets/images/icons/next.png" alt="next">
              </button>

              <button class="controlButton repeat" title="Repeat button">
                <img src="assets/images/icons/repeat.png" alt="repeat">
              </button>

            </div>

            <div class="playbackBar">

              <div class="progressTime current">0:00</div>

              <div class="progressBar">
                <div class="progressBarBg">
                  <div class="progress"></div>
                </div>
              </div>

              <div class="progressTime remaining"></div>

            </div>

          </div>

        </div>

        <div id="nowPlayingRight">
          <div class="volumeBar">
            <button class="controlButton volume" title="Volume button">
              <img src="assets/images/icons/volume.png" alt="volume">
            </button>

            <div class="progressBar">
              <div class="progressBarBg">
                <div class="progress"></div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div> <!-- end #nowPlayingBarContainer-->

    

    <!-- mob playing bar -->
    <div id="mobNowPlayingContainer">

      <div id="mobNowPlayingTop">

        <div id="mobInfo">

          <span class="albumLink">
            <img role="link" tabindex="0" src="" alt="music" class="albumArtwork albumLinkId">
          </span>

          <div class="trackInfo">
            <span class="trackName">
              <span class="albumLinkId" role="link" tabindex="0"></span>
            </span>

            <span class="artistName">
              <span class="artistLinkId" role="link" tabindex="0"></span>
            </span>
          </div>

        </div>

        <div id="mobButtons">

          <button class="controlButton likeSong" title="Like button">
            <img src="" alt="Liked songs" class="like-icon">
          </button>

          <button class="controlButton play" title="Play button">
            <img src="assets/images/icons/play.png" alt="play">
          </button>

          <button class="controlButton pause" title="Pause button" style="display: none;">
            <img src="assets/images/icons/pause.png" alt="pause">
          </button>
        </div>

      </div>

      <div id="mobNowPlayingBottom">
        <div class="playbackBar">

          <div class="progressTime current">0:00</div>

          <div class="progressBar">
            <div class="progressBarBg">
              <div class="progress"></div>
            </div>
          </div>

          <div class="progressTime remaining"></div>

        </div>
      </div>
    </div> <!-- end #mobNowPlayingContainer-->