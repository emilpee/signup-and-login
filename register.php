<?php require 'header.php' ?>

<body>
  <main class="content">
    <h1>Register</h1>
    <form action="register.php" method="post" id="reg">
        <label for="username">Username</label>
        <input type="text" name="registerUsername" required>
        <label for="password">Password</label>
        <input type="password" name="registerPassword" required>
        <input type="submit" class="btn" value="Register">
    </form>
    <span class="register">
        Already have an account?
        <a href="index.php">Go back to login.</a>
    </span>
  </main>
</body>

<?php 

  try {

    if (isset($_POST["registerUsername"]) && isset($_POST["registerPassword"])) {

      // Get login data from json file
      $url = 'logins.json';
      $data = file_get_contents($url);
      $login = json_decode($data);

      $registerUsername = $_POST["registerUsername"];
      $registerPassword = $_POST["registerPassword"];

      if ($login->username != $registerUsername) {

        echo '<p>Thank you for registering!</p>';

          // Salts
          $salt1 = "987fed";
          $salt2 = "654cba";

          // Hash users password
          $hashedPassword = password_hash($salt1 . $registerPassword . $salt2, PASSWORD_BCRYPT);

          // Store username and hashed password to json file
          $jsonArray = array("username"=>$registerUsername, "password"=>$hashedPassword);

          $fp = fopen('logins.json', 'w'); 
          fwrite($fp, json_encode($jsonArray));
          fclose($fp);

      } else {
        echo '<p>Sorry, username is already taken.</p>';
      }

    }

  } catch(Exception $error) {
      echo('There was an error: ' . $error->getMessage());
  } 

?>

<script>

    var message = document.querySelector('p');

    if (message.innerText === "Thank you for registering!") {
        message.classList.add('success');
        message.classList.toggle('showMessage');

    } else {
        message.classList.add('fail');
        message.classList.toggle('showMessage');
    }
    
</script>