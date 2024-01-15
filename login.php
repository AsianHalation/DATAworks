<?php

include 'db.php';

$db = new Database();

session_start();

if (isset($_POST['knopje']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "Logged in succesfully";

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    $user = $db->select($username);
    try {
        if ($user == false) {
            throw new exception("user does not exist");
        } else {
            $grabbedpass = $user['password'];            
        }

    // checks if password matches
    $check = password_verify($password, $grabbedpass);

    // check if input is correct
    if ($password == "" || $username == "") {
        throw new exception("Fill in every question");
    }
    if ($check == false) {
        throw new exception("Password is incorrect");
    } else {
        // log user in
        $_SESSION['loggedin'] = 1;
        $_SESSION['username'] = $username;
    }
    }
    // catch error and make error message red (if there is no exception it will say "Logged in succesfully in white")
    catch (exception $e) {
            $message = $e->getMessage();
            ?> <style>
                #error {
                    color: red;
                }
            </style> <?php
    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/formstyle.css">
    </head>
<body>
    <nav id="navbar">
        <a href="http://localhost/PDO/y2/p2/pdo/">Home</a>
        <a href="registration.php">Register</a>
        <a href="login.php">Login</a>
        <a href="logout.php">Logout</a>
    </nav>
    <h1>Login</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="knopje">Login</button>
    </form>
    <p>dont have an account? <a href="registration.php">Register</a></p>
    <p id="error"></p>
    <script>
            // display error message OR confirm account creation
            document.getElementById('error').innerText = "<?php echo $message; ?>";
    </script>
</body>
</html>