<?php

include 'db.php';

$db = new Database();

$message = "";

if (isset($_POST['knopje']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "Account created successfully";

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    $hash = password_hash($password, PASSWORD_BCRYPT);

    try {

        // check if input is correct
        if ($db->select($username) != false) {
            throw new exception("Username already exists");
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            throw new exception("Email is not valid");
        }
        if ($password == "" || $username == "" || $email == "") {
            throw new exception("Fill in every question");
        }
        if (strlen($password) < 8) {
            throw new exception("Password must be at least 8 characters long");
        }

        $db->insert($username, $email, $hash);
    }
    // catch error and make error message red
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
    <link rel="stylesheet" href="styles/Don.css">
    <link rel="stylesheet" href="styles/Milan.css">
    <link rel="stylesheet" href="styles/formstyle.css">
</head>

<body>
    <div id="container">
        <header id="header">
            <nav>
                <ul>
                    <li><a href="../DATAworks/">Home</a></li>
                    <li><a href="">Aanbod</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="#footer">Contact</a></li>
                </ul>
            </nav>
        </header>
        <div id="body">
            <h1>Register</h1>
            <form method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="knopje" id="knopje">Register</button>
            </form>
            <p>already have an account? <a href="login.php">Login</a></p>
            <p id="error"></p>
            <script>
                // display error message OR confirm account creation
                document.getElementById('error').innerText = "<?php echo $message; ?>"
            </script>
        </div>

        <footer id="footer">
            <p>postcode: 1234 BV</p><br>
            <p>straat: supaidastraat 1</p><br>
            <p>plaats: Vianen</p>
            <audio src="auto.mp3"></audio>
            <button id="musicbtn"><i class="music-on">Play/Pause</i></button>
        </footer>
    </div>
    
    <script src="js/home.js"></script>
</body>

</html>