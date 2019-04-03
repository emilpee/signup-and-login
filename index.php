<?php require 'header.php' ?>

<body>
  <main class="content">
    <h1>Login</h1>
    <form action="index.php" id="reg" method="post">
        <label for="username">Username</label>
        <input type="text" placeholder="Enter your username..." name="username" required>
        <label for="password">Password</label>
        <input type="password" placeholder="Enter your password..." name="password" required>
        <input type="submit" class="btn" value="Sign in">
    </form>
    <span class="register">
        Don't have an account? 
        <a href="register.php">Register here.</a>
    </span>
  </main>
</body>

<?php 

    try {

        if (isset($_POST["username"]) && isset($_POST["password"])) {

            $inputUsername = $_POST["username"];
            $inputPassword = $_POST["password"];

            // Salts
            $salt1 = "987fed";
            $salt2 = "654cba";

            // Get login data from json file
            $url = 'logins.json';
            $data = file_get_contents($url);
            $login = json_decode($data);

            if ($login->username == $inputUsername && password_verify($salt1 . $inputPassword . $salt2,  $login->password) == $inputPassword) {
                echo '<p>Success! You have logged in.</p>';
            } else {
                echo '<p>Username or password was incorrect.</p>';
            }

        }

    } catch(Exception $error) {
        echo('There was an error: ' . $error->getMessage());
    }

?>

<script>

    var message = document.querySelector('p');

    if (message.innerText === "Success! You have logged in.") {
        message.classList.add('success');
        message.classList.toggle('showMessage');
    } else {
        message.classList.add('fail');
        message.classList.toggle('showMessage');
    }

</script>