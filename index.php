<?php require 'header.php' ?>

<body>
  <main class="content">
    <h1>Login</h1>
    <form action="index.php" method="post">
        <label for="username">Username</label>
        <input type="text" placeholder="Enter your username..." name="username">
        <label for="password">Password</label>
        <input type="password" placeholder="Enter your password..." name="password"">
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

            $url = 'logins.json';

            $data = file_get_contents($url);
            $login = json_decode($data);

            if ($login->username == $inputUsername) {
                echo 'Username matches';
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
    } else {
        message.classList.add('fail');
    }

</script>