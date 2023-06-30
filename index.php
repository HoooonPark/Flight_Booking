<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Hello!</title>

</head>

<body>
    <header>
        <nav>
            <div class="logo">Flight Booker</div>
            <ul>
                <li><a href="login.html">Log In</a></li>
                <li><a href="register.html">Sign Up</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="background">
            <img src="assets/images/account_background.jpg" alt="background" width=100% height=auto>
        </div>
       

    </main>
</body>
</html>