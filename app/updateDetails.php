<?php 

  include 'include/includedFiles.php'; 

?>

<div class="userDetails">

 	<div class="container borderBottom">
 		<h2>Image</h2>
 		<img class="imgPro" src='assets/images/profile-pics/<?php echo $user_obj->getProfilePicture($user_id); ?>' alt="img" height="200px">
     
    <div>
        <input hidden type="file" name="profileImg" id="profileImg" class="updateImage">
        <label for="profileImg" class="inputFile">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
            <path
              d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
          </svg> 
          <span>Browse&hellip;</span>
        </label>
    </div>

 		<span class="message imgMsg"></span>
 		<button class="button profileBtn saveImg">SAVE</button>

 	</div>

	<div class="container borderBottom">
 		<h2>Username</h2>
 		<input type="text" class="updUsername" name="username" placeholder="Your New Username..." value="<?php echo $user_obj->getUsername($user_id); ?>">
 		<span class="message usernameMsg"></span>
 		<button class="button profileBtn saveUsername">SAVE</button>
 	</div>

 	<div class="container">
 		<h2>Password</h2>
 		<input type="password" class="oldPassword" name="oldPassword" placeholder="Current password">
 		<input type="password" class="newPassword" name="newPassword" placeholder="New password">
 		<span class="message passwordMsg"></span>
 		<button class="button profileBtn savePassword">SAVE</button>
 	</div>

 </div>