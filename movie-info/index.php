<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $_SESSION['movie_id'] = $_GET['id'];
    $_SESSION['price'] = $_GET['price'];
    $_SESSION['age_rating'] = $_GET['age_rating'];
    $_SESSION['title'] = $_GET['title'];
} else {
    $_SESSION['movie_id'] = 0;
}

if (isset($_POST['submit'])) {
    if ($isLoggedIn) {
        if (intval($_SESSION['age']) >= intval($_SESSION['age_rating'])) {
            header("Location: ../purchase/?id=" . $_SESSION['movie_id']);
        } else {
            $error_msg_age = "Inappropriate age to watch the movie.";
        }
    } else {
        $error_msg_guest = "Please log in first.";
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <title>SEA Cinema</title>
    <link href="../styles/shared.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../fonts/icons/css/all.css" rel="stylesheet">
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
            <div class="header-link"><a href="../"><i class="fa-solid fa-house"></i>Home</a></div>
            <div class="header-link"><a class="user-only-link" href="../tickets/"><i class="fa-solid fa-ticket"></i>Tickets</a></div>
        </div> 
        <div class="header-part">
            <div class="header-link"><a class="user-only-link" href="../profile/"><i class="fa-solid fa-user"></i>My Profile</a></div>
            <div class="header-link"><a class="user-only-link" href="../login/logout.php"><i class="fa-solid fa-door-open"></i><?php echo ($isLoggedIn) ? "Log Out": "Log In";?></a></div>
        </div>
    </div>

    <div id="main" class="window main-window">
        <div id="image-container">
            <img id="movie-img" src="">
        </div>
        <div id="content">
            <h1 id="movie-title"></h1>
            <p id="desc"></p>
            <ul>
                <li id="release-date"></li>
                <li id="age-rating"></li>
                <li id="price"></li>
            </ul>
            <form action='' method='POST'>
                <button type="submit" name="submit" id="submit">Buy a Ticket</button>
                <div class="error-msg"><?php echo isset($error_msg_age) ? $error_msg_age : ''; ?></div>
                <div class="error-msg"><?php echo isset($error_msg_guest) ? $error_msg_guest : ''; ?></div>
            </form>
        </div>
    </div>
</body>

</html>