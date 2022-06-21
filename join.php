
<?php 

  include 'includes/header.php'; 

  $account = new Account;

  include 'app/include/handlers/register_handler.php';
  include 'app/include/handlers/login_handler.php';

  if (isset($_POST['registerButton'])) {
      echo '
          <script>  

            document.addEventListener("DOMContentLoaded", function() {
              const loginForm = document.querySelector("#loginForm");
              const registerForm = document.querySelector("#registerForm");

              loginForm.style.display = "none";
              registerForm.style.display = "block";
            });

          </script>
      ';
  }


?>

<div class="container full-height-grow" data-barba="container" data-barba-namespace="join-section">

    <section class="join-main-section">

      <h1 class="join-text">
        Join the
        <span class="accent-text">fun.</span>
      </h1>

      <!-- login form -->
      <form action="#" id="loginForm" method="POST" class="join-form">

        <h2>Login to your account</h2>
        <?php echo $account->getError(Constants::$loginFailed); ?>

        <div class="input-group">
          <?php echo $account->getError(Constants::$usernameEmpty); ?>

          <label for="loginUsername">Username:</label>
          <input type="text" id="loginUsername" name="loginUsername" placeholder="Your username">
        </div>

        <div class="input-group">
          <?php echo $account->getError(Constants::$passwordEmpty); ?>

          <label for="loginPassword">Password:</label>
          <input type="password" id="loginPassword" name="loginPassword" placeholder="Your password">
        </div>

        <div class="input-group">
          <button type="submit" name="loginButton" class="btn">LOG IN</button>
        </div>

        <div class="hasAccountText">
          Don`t have account yet? Signup<span id="hideLogin"> here.</span>
        </div>
        <p class="aldminLoginInfo">login as admin: username - sajmon91 password - 123456</p>

      </form>
      <!-- end login form -->

      <!-- register form -->
      <form action="#" id="registerForm" method="POST" class="join-form">

        <h2>Create your free account</h2>

        <div class="input-group">
          <?php echo $account->getError(Constants::$usernameEmpty); ?>
          <?php echo $account->getError(Constants::$usernameCharacters); ?>
          <?php echo $account->getError(Constants::$usernameTaken); ?>

          <label for="username">Username:</label>
          <input type="text" id="username" name="username" placeholder="Your username" value="<?php getInputValue('username'); ?>">
        </div>

        <div class="input-group">
          <?php echo $account->getError(Constants::$firstNameEmpty); ?>
          <?php echo $account->getError(Constants::$firstNameCharacters); ?>

          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" placeholder="Your first name" value="<?php getInputValue('firstName'); ?>">
        </div>


        <div class="input-group">
          <?php echo $account->getError(Constants::$lastNameEmpty); ?>
          <?php echo $account->getError(Constants::$lastNameCharacters); ?>

          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" placeholder="Your last name" value="<?php getInputValue('lastName'); ?>">
        </div>



        <div class="input-group">
          <?php echo $account->getError(Constants::$emailEmpty); ?>
          <?php echo $account->getError(Constants::$emailInvalid); ?>
          <?php echo $account->getError(Constants::$emailTaken); ?>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Your email address" value="<?php getInputValue('email'); ?>">
        </div>


        <div class="input-group">
          <?php echo $account->getError(Constants::$passwordEmpty); ?>
          <?php echo $account->getError(Constants::$passwordNotAlphanumeris); ?>
          <?php echo $account->getError(Constants::$passwordCharacters); ?>

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Your password">
        </div>


        <div class="input-group">
          <button type="submit" name="registerButton" class="btn">SING UP</button>
        </div>

        <div class="hasAccountText">
          Already have account? Log in <span id="hideRegister">here.</span>
        </div>

      </form>
      <!-- end register form -->


    </section>

    <div class="join-page-circle-1"></div>
    <div class="join-page-circle-2"></div>
    <div class="join-page-circle-3"></div>

  </div>



<?php include 'includes/footer.php'; ?>