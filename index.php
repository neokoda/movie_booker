<?php
session_start();
$isLoggedIn = isset($_SESSION['username']); // check if user is logged in or not
?>

<!DOCTYPE html>

<html>

<head>
    <title>SEA Cinema</title>
    <link href="./styles/shared.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="fonts/icons/css/all.css" rel="stylesheet">
    <script src="script.js"></script>
</head>

<body>
    <script>
        window.onload = function() {
            let isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
            checkLoadGuestMode(isLoggedIn);
        };
    </script>
    <div id="nav-header">
        <div class="header-part">
            <div class="header-link"><a href=""><i class="fa-solid fa-house"></i>HOME</a></div>
            <div class="header-link"><a class="user-only-link" href="./tickets/"><i class="fa-solid fa-ticket"></i>TICKETS</a></div>
        </div> 
        <div class="header-part">
            <div class="header-link"><a class="user-only-link" href="./profile/"><i class="fa-solid fa-user"></i>MY PROFILE</a></div>
            <div class="header-link"><a class="user-only-link" href="login/logout.php"><i class="fa-solid fa-door-open"></i><?php echo ($isLoggedIn) ? "Log Out": "Log In";?></a></div>
        </div>
    </div>
    <div id="movie-catalog" class="window"></div>
</body>

</html>