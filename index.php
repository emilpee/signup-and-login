<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>Laboration 1</title>
</head>
<body>
  <main id="content">
    <h1>Login Page</h1>
    <form action="index.php" method="post">
        <label for="username">Username</label>
        <input type="text" placeholder="Enter your username..." name="username">
        <label for="password">Password</label>
        <input type="password" placeholder="Enter your password..." name="password"">
        <input type="submit" class="btn" value="Sign in">
    </form>
  </main>
</body>
</html>

<?php 

    try {

        if (isset($_POST["username"]) && isset($_POST["password"])) {

            $inputUsername = $_POST["username"];
            $inputPassword = $_POST["password"];

            // Salts
            $salt1 = "987fed";
            $salt2 = "654cba";

            // New user with pw
            $username = "admin";
            $userPw = "admin123";
            
            $hashedPw = password_hash($salt1 . $userPw . $salt2, PASSWORD_BCRYPT);

            // Check if pw is correct
            if (password_verify($salt1 . $userPw . $salt2, $hashedPw)) {
                echo "You have logged in";
            } else {
                echo "Your password is incorrect. Try again";
            }

            $jsonArray = array("username"=>$inputUsername, "password"=>$hashedPw);

            $fp = fopen('./logins.json', 'w'); 
            fwrite($fp, json_encode($jsonArray));
            fclose($fp);

        }

    } catch(Exception $error) {
        echo('There was an error: ' . $error->getMessage());
    }

?>