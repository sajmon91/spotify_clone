const playBtn = document.querySelectorAll('.play');
const pauseBtn = document.querySelectorAll('.pause');
const playbackBar = document.querySelectorAll('.playbackBar .progressBar');
const volumeBar = document.querySelector('.volumeBar .progressBar');
const nextBtn = document.querySelector('.next');
const repeatBtn = document.querySelector('.repeat');
const previousBtn = document.querySelector('.previous');
const volumeBtn = document.querySelector('.volume');
const shuffleBtn = document.querySelector('.shuffle');
const homeBtn = document.querySelectorAll('.homeLink');
const searchBtn = document.querySelectorAll('.searchLink');
const playlistBtn = document.querySelectorAll('.playlistLink');
const likedSongsBtn = document.querySelectorAll('.songsLink');
const profileBtn = document.querySelector('.profile');
const logoutBtn = document.querySelector('.logout');
const mobItems = document.querySelectorAll('.mobItem');


let albumPlayBtns;
let optionsBtn;
let timer;

const artistLink = document.querySelectorAll('.artistLinkId');
const albumLink = document.querySelectorAll('.albumLinkId');
const likeSongBtn = document.querySelectorAll('.likeSong');



let currentPlaylist = [];
let shufflePlaylist = [];
let tempPlaylist = [];

let currentIndex = 0;


let mouseDown = false;
let repeat = false;
let shuffle = false;

//////////////////////////////////////////////////////////////////////////////////


    //  menu dropdown
   document.querySelector('.dropbtn').addEventListener('click',() => {
      document.querySelector('#drop').classList.toggle('show');
   });

/////////////////////////////////////////////////////////////////////////////////////

   // Close the dropdown if the user clicks outside of it
   window.addEventListener('click', (e) => {
     let tgt = e.target;
     if (tgt.parentNode.classList.contains("dropbtn")) tgt = tgt.parentNode; 

      if (!tgt.matches('.dropbtn')){
        const dropdowns = document.querySelectorAll(".dropdown-content");
        dropdowns.forEach(drop => {
          if (drop.classList.contains('show')) {
            drop.classList.remove('show');
          }
        })
      }
   });

   
//////////////////////////////////////////////////////////////////////////////////
   
  // change bg color only on album page
   function changeAlbumBgColor() {
      const color = random_rgba();
      document.querySelector('.entityInfo').style.backgroundColor = color;
   };

/////////////////////////////////////////////////////////////

   function changeGenreBgColor() {
      document.querySelectorAll('.genreCard').forEach(el =>{
        const color = random_rgba();
        el.style.backgroundColor = color;
      });
   };

///////////////////////////////////////////////////////////

   function random_rgba() {
    const o = Math.round; 
    const r = Math.random; 
    const s = 255;
    return `rgba(${o(r()*s)}, ${o(r()*s)}, ${o(r()*s)}, 0.2)`;
  };
  

  ///////////////////////////////////////////////////////////////////////////////////////

  // audio class
  class Audio {

      currentlyPlaying;
      audio = document.createElement('audio');

      constructor(){
        this.canPlayEvent();
        this.timeUpdateEvent();
        this.volumeChangeEvent();
        this.endedEvent();
      }

      setTrack(track){
        this.currentlyPlaying = track;
        this.audio.src = track.path;
      };

      play(){
        this.audio.play();
      };

      pause(){
        this.audio.pause();
      };

      setTime(seconds){
        this.audio.currentTime = seconds;
      };

      //////////////////////////////////// events
      canPlayEvent(){
        this.audio.addEventListener('canplay', () => {
          document.querySelectorAll('.progressTime.remaining').forEach((el) => {
              const duration = formatTime(this.audio.duration);
              el.innerText = duration;
          });
        });
      };

      timeUpdateEvent(){
        this.audio.addEventListener('timeupdate', () => {
          if (this.audio.duration) {
              updateTimeProgressBar(this.audio);
          };
        });
      };

      volumeChangeEvent(){
        this.audio.addEventListener('volumechange', () => {
          updateVolumeProgressBar(this.audio);
        });
      };

      endedEvent(){
        this.audio.addEventListener('ended', () => {
          nextSong();
        });
      };
      
  }; // end Audio class

  const audioElement = new Audio;


///////////////////////////////////////////////////////////////////

  function setTrack(trackId, newPlayList, play){
    
    if (newPlayList != currentPlaylist) {
			currentPlaylist = newPlayList;
			shufflePlaylist = currentPlaylist.slice();
			shuffleArray(shufflePlaylist);
		}

    if (shuffle == true) {
      currentIndex = shufflePlaylist.indexOf(trackId);
    }else{
      currentIndex = currentPlaylist.indexOf(trackId);
    }

    pauseSong();

    fetch('include/handlers/ajax/getSongJson.php',{
      method: 'POST',
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(trackId)
    })
    .then(response =>{
      if (response.ok) {
        return response.json();
      }else{
        throw new new Error;
      }
    })
    .then(data =>{

      audioElement.setTrack(data);

      // set track name
      document.querySelector('#nowPlayingBarContainer .trackInfo .trackName span').innerText = data.title;
      document.querySelector('#mobNowPlayingContainer .trackInfo .trackName span').innerText = data.title;


      // set track artist 
      document.querySelector('#nowPlayingBarContainer .trackInfo .artistName span').innerText = data.artist;
      document.querySelector('#mobNowPlayingContainer .trackInfo .artistName span').innerText = data.artist;


      // set album artwork
      document.querySelector('#nowPlayingBarContainer .content .albumLink img').src = data.albumArtwork;
      document.querySelector('#mobNowPlayingContainer .albumLink img').src = data.albumArtwork;
      
      //artist link
      artistLink.forEach(el => {
        el.dataset.id = data.artistId;
        el.addEventListener('click', (e) => {
          const arId = e.currentTarget.dataset.id;
          openPage(`artist.php?id=${arId}`);
        });
      })

      //album link
      albumLink.forEach(el => {
        el.dataset.id = data.albumId;
        el.addEventListener('click', (e) => {
          const alId = e.currentTarget.dataset.id;
          openPage(`album.php?id=${alId}`);
        });
      });


      // like song
      let songLike;
      const sendData = {
        'songId' : trackId,
        'userId' : userLoggedInId
      };

      fetch('include/handlers/ajax/checkLikeSongJson.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(sendData)
      })
      .then(response => {
        if (response.ok) {
          return response.json();
        }else{
          throw new Error;
        }
      })
      .then(likeData => {
        songLike = likeData;

        const imageName = songLike ? 'heart_full.png' : 'heart_epmty.png';
        document.querySelectorAll('.controlButton.likeSong img').forEach(img => {
          img.src = `assets/images/icons/${imageName}`;
        });

        likeSongBtn.forEach(el => {

          el.dataset.id = data.songId;

          el.removeEventListener('click', likeEvent);
          el.addEventListener('click', likeEvent);

          function likeEvent(e){
            songLike = !songLike;
            const imageName = songLike ? 'heart_full.png' : 'heart_epmty.png';
            document.querySelectorAll('.controlButton.likeSong img').forEach(img => {
              img.src = `assets/images/icons/${imageName}`;
            });
            const cur = e.currentTarget.dataset.id;
            likeSong(cur, songLike);
          };

        });


      })

    })
    .catch(err => console.log(err));

    if (play) {
      playSong();
      audioElement.audio.autoplay = true;
    }

    

  };

///////////////////////////////////////////////////////////////////

  function playSong(){
      
    if (audioElement.audio.currentTime >= 0 || audioElement.audio.autoplay == true) {

      fetch('include/handlers/ajax/updatePlays.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(audioElement.currentlyPlaying.songId)
      })
      .catch(err => console.error(err))
    };

    playBtn.forEach((el) =>{
      el.style.display = 'none';
    });

    pauseBtn.forEach((el) =>{
      el.style.display = 'inline';
    });

    audioElement.play();
  };

//////////////////////////////////////////////////////////////////

  function pauseSong(){

    playBtn.forEach((el) =>{
      el.style.display = 'inline';
    });

    pauseBtn.forEach((el) =>{
      el.style.display = 'none';
    });

    audioElement.pause();
  };

///////////////////////////////////////////////////////////////////////

  function nextSong(){

    if (repeat) {
      audioElement.setTime(0);
      playSong();
      return;
    }

    if (currentIndex == currentPlaylist.length - 1) {
      currentIndex = 0;
    }else{
      currentIndex++;
    }

    const trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);

  };

/////////////////////////////////////////////////////////////////////////////

  function prevSong(){
    if (audioElement.audio.currentTime >= 3 || currentIndex == 0){
      audioElement.setTime(0);
    }else{
      currentIndex--;
      setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
  };

/////////////////////////////////////////////////////////////////////////////

  function setRepeat(){
    repeat = !repeat;
    const imageName = repeat ? 'repeat-active.png' : 'repeat.png';
    document.querySelector('.controlButton.repeat img').src = `assets/images/icons/${imageName}`;
  };

///////////////////////////////////////////////////////////////////////////////

  function setMute(){
    audioElement.audio.muted = !audioElement.audio.muted;
    const imageName = audioElement.audio.muted ? 'volume-mute.png' : 'volume.png';
    document.querySelector('.controlButton.volume img').src = `assets/images/icons/${imageName}`;
  };

////////////////////////////////////////////////////////////////////////////////

  function setShuffle(){
    shuffle = !shuffle;
    const imageName = shuffle ? 'shuffle-active.png' : 'shuffle.png';
    document.querySelector('.controlButton.shuffle img').src = `assets/images/icons/${imageName}`;

    if (shuffle == true) {
      // randomize playlist
      shuffleArray(shufflePlaylist);
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.songId);
    }else{
      // back to regular playlist
      currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.songId);
    }
  };

/////////////////////////////////////////////////////////////////////////////////

  function likeSong(song_Id, booleanValue){

    if (booleanValue == true) {
      const sendData = {
        'songId' : song_Id,
        'userId' : userLoggedInId
      };
      fetch('include/handlers/ajax/likeSong.php', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(sendData)
        })
        .then(response =>{
          if(!response.ok){
            throw new Error;
          }
        })
        .catch(err => console.error(err));

    }else{

      const sendData = {
        'songId' : song_Id,
        'userId' : userLoggedInId
      };
      fetch('include/handlers/ajax/dislikeSong.php', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(sendData)
        })
        .then(response =>{
          if(!response.ok){
            throw new Error;
          }
        })
        .catch(err => console.error(err));
      
    }
      
  };

/////////////////////////////////////////////////////////////////////////////

  function shuffleArray(array){
    let j, x, i;
    for(i = array.length - 1; i > 0; i--){
      j = Math.floor(Math.random() * (i + 1));
      x = array[i];
      array[i] = array[j];
      array[j] = x;
    }
    return array;
  };

/////////////////////////////////////////////////////////////////////////////

  function formatTime(timeInSeconds){

    const time = Math.round(timeInSeconds);
    const minutes = Math.floor(time / 60);
    const seconds = time - minutes * 60;

    const extraZero = (seconds < 10) ? "0" : "";

    return minutes + ':'+ extraZero + seconds;
  };


////////////////////////////////////////////////////////////////////////////////

  function updateTimeProgressBar(audio){

    document.querySelectorAll('.progressTime.current').forEach((el) => {
        const duration = formatTime(audio.currentTime);
        el.innerText = duration;
    });

    document.querySelectorAll('.progressTime.remaining').forEach((el) => {
        const duration = formatTime(audio.duration - audio.currentTime);
        el.innerText = duration;
    });

    const progress = audio.currentTime / audio.duration * 100;
    document.querySelectorAll('.playbackBar .progress').forEach((el) => {
        el.style.width = progress + '%';
    });
  };

////////////////////////////////////////////////////////////////////////////////

  function timeFromOffset(mouse, progressBar){
    const percentage = mouse.offsetX / progressBar.clientWidth * 100;
    const seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
  };

///////////////////////////////////////////////////////////////////////////////////

  function updateVolumeProgressBar(audio){
    const volume = audio.volume * 100;
    document.querySelector('.volumeBar .progress').style.width = volume + '%';
  };

  updateVolumeProgressBar(audioElement.audio);

////////////////////////////////////////////////////////////////////////////////

  function openPage(url){

    if (timer != null) {
      clearTimeout(timer);
    }

    if (url.indexOf('?') == -1) {
      url = url + '?';
    }

    const encodedUrl = encodeURI(url);
    const reqHeaders = new Headers({
      "X-Custom-Header": "ThisMeansAjaxRequest",
    });

    fetch(encodedUrl, {headers: reqHeaders})
    .then(res => {
      return res.text();
    })
    .then(body => {
      document.querySelector('#mainContent').innerHTML = body;

      document.querySelector('body').scrollTop = 0;
      window.history.pushState(url, null, url);

      if (window.history.state.split('?')[0] == 'album.php') {
        changeAlbumBgColor();
      };

      if (window.history.state.split('?')[0] == 'profile.php') {
        changeAlbumBgColor();

        const updateProf = document.querySelector('.updateDetails');
        updateProf.addEventListener('click', () => {
          openPage('updateDetails.php');
        });
      };

      if (window.history.state.split('?')[0] == 'updateDetails.php') {
        updateImage();
        updateUsername();
        updatePassword();
      };

      if (window.history.state.split('?')[0] == 'search.php') {
        timerFunction();
        changeGenreBgColor();
      };

      if (window.history.state.split('?')[0] == 'yourPlaylists.php') {
        createPlaylist();
      };

      if (window.history.state.split('?')[0] == 'playlist.php') {
        const playId = document.querySelector('.entityInfo.playlistId').dataset.id;
        const owner = document.querySelector('.entityInfo.playlistId').dataset.owner;

        if (owner) {
          deletePlaylist(playId);
          removeFromPlaylist(playId);
          updatePlaylistImage(playId);
        }else{
          likePlaylist(playId, userLoggedInId);
        }
      };

      albumPlayBtns = document.querySelectorAll('.albumPlays');
      albumPlay();

      if (window.history.state.split('?')[0] != 'yourPlaylists.php' || window.history.state.split('?')[0] != 'song.php') {
        options();
      };

      if (window.history.state.split('?')[0] == 'addGenre.php') {
        changeGenreBgColor();
        addGenre();
      };

      if (window.history.state.split('?')[0] == 'addArtist.php') {
        addArtist();
      };

      if (window.history.state.split('?')[0] == 'addAlbum.php') {
        addAlbum();
      };

      if (window.history.state.split('?')[0] == 'addSong.php') {
        addSong();
      };

    });

  };


///////////////////////////////////////////////////////////////////////////////////

  function playFirstSong(){
    setTrack(tempPlaylist[0], tempPlaylist, true);
  };

///////////////////////////////////////////////////////////////////////

  function songPagePlay(songId){
    const arr = String(songId).split(" ").map((num)=>{
      return Number(num);
    });
    setTrack(songId, arr, true);
  };

////////////////////////////////////////////////////////////////////////

  function timerFunction(){
    const searchInput = document.querySelector('.searchInput');

    searchInput.addEventListener('focus', () => {
      const val = searchInput.value;
      searchInput.value = '';
      searchInput.value = val;
    });

    searchInput.focus();

    searchInput.addEventListener('keyup', () => {
        clearTimeout(timer);

        timer = setTimeout(() => {
          const value = searchInput.value;
          openPage(`search.php?term=${value}`);
        }, 1000);
    });
  };

////////////////////////////////////////////////////////////////////////////////

  function updateImage(){
    const uplImg = document.querySelector('.updateImage');
    const img = document.querySelector('.imgPro');
    const saveImgBtn = document.querySelector('.saveImg');
    const imageMsg = document.querySelector('.imgMsg');

    uplImg.addEventListener('change', () => {
      const [file] = uplImg.files;
      img.src = URL.createObjectURL(file);
    });

    saveImgBtn.addEventListener('click', () => {
      const image_files = document.getElementById('profileImg').files[0];
      
      if (image_files === undefined) {
        imageMsg.classList.add('errorMsg');
        imageMsg.innerText = 'You must take picture';
        return;
      }

      if(image_files.size > 2 * 1024 * 1024){
        imageMsg.classList.add('errorMsg');
        imageMsg.innerText = 'File must be less than 2 MB';
        uplImg.value = '';
        return;
      }

      if(!['image/jpeg', 'image/png'].includes(image_files.type)){
        imageMsg.classList.add('errorMsg');
        imageMsg.innerText = 'Only .jpg and .png image are allowed';
        uplImg.value = '';
        return;
      }
  
      let formData = new FormData();
      formData.append('image', image_files);
      formData.append('userId', userLoggedInId);

      fetch('include/handlers/ajax/updateProfileImg.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok){
          return response.json();
        }else{
          throw new Error;
        }
      })
      .then(data => {

        if (data.status) {
          imageMsg.classList.remove('errorMsg');
          imageMsg.classList.add('successMsg');
          imageMsg.innerText = data.msg;
          document.querySelector('.profilePic img').src = `assets/images/profile-pics/${data.image}`;
        }else{
          imageMsg.classList.add('errorMsg');
          imageMsg.innerText = data.msg;
        }
      })
      .catch(err => console.error(err));

    });
  };

///////////////////////////////////////////////////////////////////////////////

  function updateUsername(){
    const saveUsernameBtn = document.querySelector('.saveUsername');
    const usernameMsg = document.querySelector('.usernameMsg');

    saveUsernameBtn.addEventListener('click', () => {
      const username = document.querySelector('.updUsername').value;

      const sendData = {
        'username' : username,
        'userId' : userLoggedInId
      };
      fetch('include/handlers/ajax/updateUsername.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(sendData)
      })
      .then(response =>{
        if(!response.ok){
          throw new Error;
        }
        return response.json();
      })
      .then(data =>{
       
        if (data.status) {
          usernameMsg.classList.remove('errorMsg');
          usernameMsg.classList.add('successMsg');
          usernameMsg.innerText = data.msg;
          document.querySelector('.dropbtn span').innerText = data.username;
        }else{
          usernameMsg.classList.add('errorMsg');
          usernameMsg.innerText = data.msg;
        }
      })
      .catch(err => console.error(err));

    });
  };

/////////////////////////////////////////////////////////////////////////////////

  function updatePassword(){
    const savePasswordBtn = document.querySelector('.savePassword');
    const passwordMsg = document.querySelector('.passwordMsg');

    savePasswordBtn.addEventListener('click',() => {
      const oldPassword = document.querySelector('.oldPassword').value;
      const newPassword = document.querySelector('.newPassword').value;

      const sendData = {
        'oldPassword' : oldPassword,
        'newPassword' : newPassword,
        'userId' : userLoggedInId
      };
      fetch('include/handlers/ajax/updatePassword.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(sendData)
      })
      .then(response =>{
        if(!response.ok){
          throw new Error;
        }
        return response.json();
      })
      .then(data =>{
       
        if (data.status) {
          passwordMsg.classList.remove('errorMsg');
          passwordMsg.classList.add('successMsg');
          passwordMsg.innerText = data.msg;
        }else{
          passwordMsg.classList.add('errorMsg');
          passwordMsg.innerText = data.msg;
        }
      })
      .catch(err => console.error(err));


    });
  };

////////////////////////////////////////////////////////////////////////////////

  function addGenre(){
    const addGenreBtn = document.querySelector('.addGenreBtn');

    addGenreBtn.addEventListener('click', () => {
      const genre = document.querySelector('.genre').value;

      if (genre.length > 0) {
        fetch('include/handlers/ajax/addNewGenre.php', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(genre)
        })
        .then(response =>{
          if(!response.ok){
            throw new Error;
          }
          openPage('addGenre.php');
        })
        .catch(err => console.error(err));
      }
    });
  };

////////////////////////////////////////////////////////////////////////////////

  function addArtist() {
    const uplImg = document.querySelector('.arImg');
    const imgCard = document.querySelector('.artistCard .addArtistCardImg');
    const artistNameInput = document.querySelector('.artistInput');
    const saveBtn = document.querySelector('.addArtistBtn');
    

    uplImg.addEventListener('change', () => {
      const [file] = uplImg.files;

      if(file.size > 2 * 1024 * 1024){
        Swal.fire('File must be less than 2 MB', '', 'error');
        return;
      }

      if(!['image/jpeg', 'image/png'].includes(file.type)){
        Swal.fire('Only .jpg and .png image are allowed', '', 'error');
        return;
      }

      imgCard.src = URL.createObjectURL(file);
    });

    artistNameInput.addEventListener('keyup', () => {
      document.querySelector('.gridViewInfo .addArtistCardName').innerHTML = artistNameInput.value;
    });

    saveBtn.addEventListener('click', () => {
      const [file] = uplImg.files;
      const artist = artistNameInput.value
      
      if (file === undefined) {
        Swal.fire('Artist image are empty', '', 'error');
        return;
      }

      if (artist == '') {
        Swal.fire('Artist name are empty', '', 'error');
        return;
      }

      let formData = new FormData();
      formData.append('artistImage', file);
      formData.append('artistName', artist);

      fetch('include/handlers/ajax/addNewArtist.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok){
          return response.json();
        }else{
          throw new Error;
        }
      })
      .then(data => {
        if (data.status) {
          Swal.fire(`${data.msg}`, '', 'success');
          openPage('addArtist.php');
        }else{
          Swal.fire(`${data.msg}`, '', 'error');
        }
      })
      .catch(err => console.error(err));

    });

  };

////////////////////////////////////////////////////////////////////////////////

  function addAlbum() {
    const albumTitle = document.querySelector('.albumTitle');
    const selectArtist = document.querySelector('#albumArtist');
    const selectGenre = document.querySelector('#albumGenre');
    const uplImg = document.querySelector('.alImg');
    const imgCard = document.querySelector('.gridViewItem .addAlbumCardImg');
    const saveBtn = document.querySelector('.addAlbumBtn');

    uplImg.addEventListener('change', () => {
      const [file] = uplImg.files;

      if(!['image/jpeg', 'image/png'].includes(file.type)){
        Swal.fire('Only .jpg and .png image are allowed', '', 'error');
        return;
      }

      if(file.size > 2 * 1024 * 1024){
        Swal.fire('File must be less than 2 MB', '', 'error');
        return;
      }

      imgCard.src = URL.createObjectURL(file);
    });

    albumTitle.addEventListener('keyup', () => {
      document.querySelector('.gridViewItem .gridViewInfo .albumName').innerHTML = albumTitle.value;
    });

    selectArtist.addEventListener('change', () => {
      document.querySelector('.gridViewItem .gridViewInfo .albumArtist').innerHTML = selectArtist.options[selectArtist.selectedIndex].text;
    });


    saveBtn.addEventListener('click', () => {
      const album = albumTitle.value;
      const artist = selectArtist.value;
      const genre = selectGenre.value;
      const [file] = uplImg.files;

      if (album == '') {
        Swal.fire('Album title are empty', '', 'error');
        return;
      }

      if (artist == '') {
        Swal.fire('Select artist', '', 'error');
        return;
      }

      if (genre == '') {
        Swal.fire('Select genre', '', 'error');
        return;
      }

      if (file === undefined) {
        Swal.fire('Album artwork are empty', '', 'error');
        return;
      }

      let formData = new FormData();
      formData.append('albumTitle', album);
      formData.append('artist', artist);
      formData.append('genre', genre);
      formData.append('albumArtwork', file);

      fetch('include/handlers/ajax/addNewAlbum.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok){
          return response.json();
        }else{
          throw new Error;
        }
      })
      .then(data => {
        if (data.status) {
          Swal.fire(`${data.msg}`, '', 'success');
          openPage('addAlbum.php');
        }else{
          Swal.fire(`${data.msg}`, '', 'error');
        }
      })
      .catch(err => console.error(err));

    });

  };

////////////////////////////////////////////////////////////////////////////////

  function addSong() {
    const songTitle = document.querySelector('.songTitle');
    const selectArtist = document.querySelector('#songArtist');
    const selectAlbum = document.querySelector('#songAlbum');
    const selectGenre = document.querySelector('#songGenre');
    const songFile = document.querySelector('#song');
    const youtubeLink = document.querySelector('.youtubeLink');
    const saveBtn = document.querySelector('.addSongBtn');

    selectArtist.addEventListener('change', () => {

      selectAlbum.innerHTML = '<option value="">Select Album</option>';

      const sendData = {
        'artistId' : selectArtist.value
      };
      fetch('include/handlers/ajax/getArtistAlbum.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(sendData)
      })
      .then(response =>{
        if(!response.ok){
          throw new Error;
        }
        return response.json();
      })
      .then(data =>{
        data.forEach(el => {
          const html = `<option value="${el.id}">${el.title}</option>`;
          selectAlbum.insertAdjacentHTML('beforeend', html);
        })
      })
      .catch(err => console.error(err));

    });

    songFile.addEventListener('change', () => {
      const [file] = songFile.files;

      if(!['audio/mpeg'].includes(file.type)){
        Swal.fire('Only .mp3 song are allowed', '', 'error');
        return;
      }

      let formData = new FormData();
      formData.append('song', file)

      fetch('include/handlers/ajax/getSongDuration.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok){
          return response.json();
        }else{
          throw new Error;
        }
      })
      .then(data => {
        document.querySelector('.inputContainer .songDuration').innerText = formatTime(data);
      })
      .catch(err => console.error(err));
    });

    saveBtn.addEventListener('click', () => {
      const title = songTitle.value;
      const artist = selectArtist.value;
      const album = selectAlbum.value;
      const genre = selectGenre.value;
      const duration = document.querySelector('.inputContainer .songDuration').textContent;
      const [file] = songFile.files;
      const youtube = youtubeLink.value;

      if (title == '') {
        Swal.fire('Song title are empty', '', 'error');
        return;
      }

      if (artist == '') {
        Swal.fire('Select artist', '', 'error');
        return;
      }

      if (album == '') {
        Swal.fire('Select album', '', 'error');
        return;
      }

      if (genre == '') {
        Swal.fire('Select genre', '', 'error');
        return;
      }

      if (file === undefined) {
        Swal.fire('Chose a song', '', 'error');
        return;
      }

      let formData = new FormData();
      formData.append('title', title);
      formData.append('artist', artist);
      formData.append('album', album);
      formData.append('genre', genre);
      formData.append('duration', duration);
      formData.append('song', file);
      formData.append('youtube', youtube);
    

      fetch('include/handlers/ajax/addNewSong.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok){
          return response.json();
        }else{
          throw new Error;
        }
      })
      .then(data => {
      
        if (data.status) {
          Swal.fire(`${data.msg}`, '', 'success');
          openPage('addSong.php');
        }else{
          Swal.fire(`${data.msg}`, '', 'error');
        }
      })
      .catch(err => console.error(err));

    });

  };

/////////////////////////////////////////////////////////////////////////////////

  // event listeners

  // play button click
  playBtn.forEach((el) => {
    el.addEventListener('click', () => {
        playSong();
    });
  });

  // pause button click
  pauseBtn.forEach((el) => {
    el.addEventListener('click', () => {
        pauseSong();
    });
  });

  // next button click
  nextBtn.addEventListener('click', () => {
    nextSong();
  });

  // previous button click
  previousBtn.addEventListener('click', () => {
    prevSong();
  });

  // repeat button click
  repeatBtn.addEventListener('click', () => {
    setRepeat();
  });

  // volume button click
  volumeBtn.addEventListener('click', () => {
    setMute();
  });

  // shuffle button click
  shuffleBtn.addEventListener('click', () => {
    setShuffle();
  });

  // playback bar progress
  playbackBar.forEach((el) => {
    el.addEventListener('mousedown', () => {
      mouseDown = true;
    });
  });

  playbackBar.forEach((progressBar) => {
    progressBar.addEventListener('mousemove', (mouseEvent) => {
      if (mouseDown) {
        timeFromOffset(mouseEvent, progressBar);
      }
    });
  });

  playbackBar.forEach((progressBar) => {
    progressBar.addEventListener('mouseup', (mouseEvent) => {
      timeFromOffset(mouseEvent, progressBar);
    });
  });

  document.addEventListener('mouseup', () => {
    mouseDown = false;
  });

  // volume bar
  volumeBar.addEventListener('mousedown', () => {
    mouseDown = true;
  });

  volumeBar.addEventListener('mousemove', (mouseEvent) => {
    if (mouseDown) {
      const percentage = mouseEvent.offsetX / volumeBar.clientWidth;

      if (percentage >= 0 && percentage <= 1) {
        audioElement.audio.volume = percentage;
      }
    }
  });

  volumeBar.addEventListener('mouseup', (mouseEvent) => {
    const percentage = mouseEvent.offsetX / volumeBar.clientWidth;

    if (percentage >= 0 && percentage <= 1) {
      audioElement.audio.volume = percentage;
    }
  });

  // album play button click
  function albumPlay() {
    let sIdArray = [];
    albumPlayBtns.forEach(s => {
      sIdArray.push(s.dataset.songid);
      tempPlaylist = sIdArray;

      s.addEventListener('click', (e) =>{
        const songid = e.currentTarget.dataset.songid;

        setTrack(songid, tempPlaylist, true);
      });
    });
  };
  


  // no highlight
  document.querySelector('#nowPlayingBarContainer').addEventListener('mousedown', (e) => {
    e.preventDefault();
  });

  document.querySelector('#mobNowPlayingContainer').addEventListener('mousedown', (e) => {
    e.preventDefault();
  });

  // home button click
  homeBtn.forEach(el => {
    el.addEventListener('click', () => {
      openPage('index.php');
    });
  });

  // search button click
  searchBtn.forEach(el => {
    el.addEventListener('click', () => {
      openPage('search.php');
    });
  });

  // playlist button click
  playlistBtn.forEach(el => {
    el.addEventListener('click', () => {
      openPage('yourPlaylists.php');
    });
  });

  // liked song button click
  likedSongsBtn.forEach(el => {
    el.addEventListener('click', () => {
      openPage('likedSongs.php');
    });
  });

  // create playlist
  function createPlaylist() {
    const createPlaylistBtn = document.querySelector('.playlistButton');

    createPlaylistBtn.addEventListener('click', () => {

      Swal.fire({
          title: "New Playlist",
          text: "Write playlist name",
          input: 'text',
          confirmButtonColor: '#2ebd59',
          showCancelButton: true        
      }).then((result) => {

        if (result.value) {

            const sendData = {
              'playlistName' : result.value,
              'userId' : userLoggedInId
            };
            fetch('include/handlers/ajax/createPlaylist.php', {
                method: 'POST',
                headers: {
                  "Content-Type": "application/json"
                },
                body: JSON.stringify(sendData)
              })
              .then(response => {
                if (response.ok){
                  openPage('yourPlaylists.php');
                }else{
                  throw new Error;
                }
              })
              .catch(err => console.error(err));
        };

      });

    });
  };

////////////////////////////////////////////////////////////////////////

  function deletePlaylist(playlistId) {
      const deletePlaylistBtn = document.querySelector('.deletePlaylist');

      deletePlaylistBtn.addEventListener('click',() =>{

        Swal.fire({
            title: "Delete Playlist",
            text: "Do You want to delete this playlist?",
            icon: 'error',
            confirmButtonColor: '#2ebd59',
            showCancelButton: true        
        }).then((result) => {

          if (result.isConfirmed) {

            fetch('include/handlers/ajax/deletePlaylist.php', {
              method: 'POST',
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify(playlistId)
            })
            .then(response => {
              if (response.ok){
                Swal.fire('Playlist Deleted', '', 'success');
                openPage('yourPlaylists.php');
              }else{
                throw new Error;
              }
            })
            .catch(err => console.error(err));
          };

        });

      });
  };
    
///////////////////////////////////////////////////////////////////////

  function likePlaylist(playlistId, userId){
    let playlistLikes;
    const sendData = {
      'playlistId': playlistId,
      'userId': userId
    };

    fetch('include/handlers/ajax/checkLikePlaylistJson.php', {
      method: 'POST',
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(sendData)
    })
    .then(response => {
      if (response.ok) {
        return response.json();
      }else{
        throw new Error;
      }
    })
    .then(likeData => {
    
      playlistLikes = likeData;
      const imageName = playlistLikes ? 'heart_full.png' : 'heart_epmty.png';

      document.querySelector('.likePlaylist .likePlay').src = `assets/images/icons/${imageName}`;

      document.querySelector('.likePlaylist').addEventListener('click', () => {
        playlistLikes = !playlistLikes;
        const imageName = playlistLikes ? 'heart_full.png' : 'heart_epmty.png';

        document.querySelector('.likePlaylist .likePlay').src = `assets/images/icons/${imageName}`;

        playlistLike(playlistId, playlistLikes);
      });


    })
    .catch(err => console.log(err));

  };
  
////////////////////////////////////////////////////////

  function playlistLike(playlist, booleanValue){
    if (booleanValue == true){
      
      const sendData = {
        'playlistId' : playlist,
        'userId' : userLoggedInId
      };
      fetch('include/handlers/ajax/likePlaylist.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(sendData)
      })
      .then(response =>{
        if(!response.ok){
          throw new Error;
        }
      })
      .catch(err => console.error(err));

    }else{
      const sendData = {
        'playlistId' : playlist,
        'userId' : userLoggedInId
      };
      fetch('include/handlers/ajax/dislikePlaylist.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(sendData)
      })
      .then(response =>{
        if(!response.ok){
          throw new Error;
        }
      })
      .catch(err => console.error(err));
    };
  };

//////////////////////////////////////////////////////////////////////////////

  // option button click
  function options(){
    optionsBtn = document.querySelectorAll('.trackOptions .optionsButton');
    optionsBtn.forEach(el => {
      el.addEventListener('click', () => {
        showOptionsMenu(el);
      });
    });
  };

////////////////////////////////////////////////////////////////////

  function showOptionsMenu(button){
    const songId = button.previousElementSibling.value;
    const menu = document.querySelector('.optionsMenu');
    menu.querySelector('.songId').value = songId;

    const select = menu.querySelector('.playlistSelect');
    selectChange(select);

    downloadSong(songId);
    
    menu.style.display = 'block';
    const menuWidth = menu.clientWidth;
    menu.style.display = 'none';

    const scrollTop = window.pageYOffset; 
    const elementOffset = button.offsetTop;
    const top = elementOffset - scrollTop;
    const left = button.offsetLeft;

    menu.style.cssText = `
      top: ${top}px;
      left: ${left - menuWidth}px;
      display: inline;
    `;
  };

//////////////////////////////////////////////////////////////////////////

  function selectChange(select) {
    select.addEventListener('change', () => {
      const playlistId = select.value;
      const songId = select.previousElementSibling.value;
      const sendData = {
        'playlistId' : playlistId,
        'songId' : songId
      };
      fetch('include/handlers/ajax/addToPlaylist.php', {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(sendData)
      })
      .then(response =>{
        if(!response.ok){
          throw new Error;
        }else{
          hideOptionsMenu();
          select.value ='';
        }

      })
      .catch(err => console.error(err));

    }, {once : true});
  };

//////////////////////////////////////////////////////////////////////////

  function hideOptionsMenu(){
    const menu = document.querySelector('.optionsMenu');

    if (menu != null) {
      if (menu.style.display != 'none') {
        menu.style.display = 'none';
      }
    }
    
  };

///////////////////////////////////////////////////////////////////////////

  function removeFromPlaylist(playlistId) {
    const removeFromPlaylistBtn = document.querySelectorAll('.removeFromPlaylist');
    removeFromPlaylistBtn.forEach(el => {
      el.addEventListener('click', () => {
        const songId = el.parentElement.firstElementChild.value;
        const sendData = {
          'playlistId' : playlistId,
          'songId' : songId
        };

        fetch('include/handlers/ajax/removeFromPlaylist.php', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(sendData)
        })
        .then(response =>{
          if(!response.ok){
            throw new Error;
          }else{
            openPage(`playlist.php?id=${playlistId}`);
          }
  
        })
        .catch(err => console.error(err));
      });
    });
  };

////////////////////////////////////////////////////////////////////////////

  function updatePlaylistImage(playlistId){
    const uplImg = document.querySelector('.playlistImage');
    const img = document.querySelector('.playlistId .leftSection img');
    const playlistMsg = document.querySelector('.playlistMsg');

    uplImg.addEventListener('change', () => {
      const [file] = uplImg.files;

      if(file.size > 2 * 1024 * 1024){
        Swal.fire('File must be less than 2 MB', '', 'error');
        return;
      }

      if(!['image/jpeg', 'image/png'].includes(file.type)){
        Swal.fire('Only .jpg and .png image are allowed', '', 'error');
        return;
      }

      let formData = new FormData();
      formData.append('playlistImage', file);
      formData.append('playlistId', playlistId);

      fetch('include/handlers/ajax/updatePlaylistImg.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok){
          return response.json();
        }else{
          throw new Error;
        }
      })
      .then(data => {

        if (data.status) {
          img.src = `assets/images/playlists-img/${data.image}`;
        }else{
          playlistMsg.innerText = data.msg;
        }

      })
      .catch(err => console.error(err));

    });

  };

/////////////////////////////////////////////////////////////////////////////

  function downloadSong(songId){

    const downloadBtn = document.querySelector('.download');

    fetch('include/handlers/ajax/getSongPath.php', {
      method: 'POST',
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(songId)
    })
    .then(response =>{
      if(!response.ok){
        throw new Error;
      }else{
        return response.json();
      }
    })
    .then(data =>{
      downloadBtn.href = data;
    })
    .catch(err => console.error(err));
    
    downloadBtn.addEventListener('click',() => {
      hideOptionsMenu();
    });
  };

/////////////////////////////////////////////////////////////////////////////

  document.addEventListener('click', (e) => {
    const target = e.target;

    if (!target.classList.contains('item') && !target.classList.contains('optionsButton')) {
      hideOptionsMenu();
    }
  });

////////////////////////////////////////////////////////////////////////////////

  window.addEventListener('scroll', () => {
    hideOptionsMenu();
  });

///////////////////////////////////////////////////////////////////////

  profileBtn.addEventListener('click', () => {
    openPage('profile.php');
  });

/////////////////////////////////////////////////////////////////////

  logoutBtn.addEventListener('click', () => {
    fetch('include/handlers/ajax/logout.php', {
      method: 'POST',
      headers: {
        "Content-Type": "application/json"
      }
    })
    .then(response => {
      if (response.ok){
        location.reload();
      }else{
        throw new Error;
      }
    })
    .catch(err => console.error(err));
  });

//////////////////////////////////////////////////////////////////////////

  mobItems.forEach((el) => {
    el.addEventListener('click', () => {
      mobItems.forEach(bu => {
        bu.classList.remove('active');
      })
      el.classList.add('active');
    })
  });

////////////////////////////////////////////////////////////////////////

  if (userRole == 'admin') {

    document.querySelector('.addGenreLink').addEventListener('click', () =>{
      openPage('addGenre.php');
    });

    document.querySelector('.addArtistLink').addEventListener('click', () =>{
      openPage('addArtist.php');
    });

    document.querySelector('.addAlbumLink').addEventListener('click', () =>{
      openPage('addAlbum.php');
    });

    document.querySelector('.addSongLink').addEventListener('click', () =>{
      openPage('addSong.php');
    });
    
  }  

////////////////////////////////////////////////////////////////////////

  // fetch random song on first load
  function getRandomSongs(){

    fetch('include/handlers/ajax/getRandomSongsJson.php')
          .then(response => {
            if (response.ok) {
              return response.json();
            }else{
              throw new Error;
            }
          })
          .then(data =>{
            setTrack(data[0], data, false);
          })
          .catch(err =>{
            console.log(err);
          });
  };

  getRandomSongs();

/////////////////////////////////////////////////////////////////////////


