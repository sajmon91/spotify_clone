<?php 

  include 'include/includedFiles.php'; 

?>

<div class="profileInfo entityInfo">

  <div class="leftSection">
    <img src='assets/images/profile-pics/<?php echo $user_obj->getProfilePicture($user_id); ?>'>
  </div>

  <div class="rightSection">
    <p>Profile</p>
    <h2><?php echo $user_obj->getUsername($user_id); ?></h2>
    <p><?php echo $user_obj->getFirstAndLastName($user_id); ?></p>
    <p><?php echo $user_obj->getEmail($user_id); ?></p>
  </div>

</div>

<button class="updateDetails">Update Details</button>


  