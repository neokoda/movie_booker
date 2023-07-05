<?php
session_start();

if (isset($_POST['submit'])) {
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['time'] = $_POST['time'];

    $movie_day = strtotime($_SESSION['date']);
    $current_day = strtotime(date('Y-m-d'));
    
    if ($movie_day > $current_day) {
        header("Location: ./select_seat.php");
    } elseif ($movie_day === $current_day) {
        $current_time = date('H:i:s');
        $movie_time = strtotime($_SESSION['time']);
        if ($movie_time >= $current_time) {
            header("Location: ./select_seat.php");
        }
        $error_msg_date = "The movie booking time has expired.";
    } 
    else {
        $error_msg_date = "The movie booking time has expired.";
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
    <div id="nav-header">
        <div class="header-part">
            <div class="header-link"><a href="../"><i class="fa-solid fa-house"></i>Home</a></div>
            <div class="header-link"><a class="user-only-link" href="../tickets/"><i class="fa-solid fa-ticket"></i>Tickets</a></div>
        </div> 
        <div class="header-part">
            <div class="header-link"><a class="user-only-link" href="../profile/"><i class="fa-solid fa-user"></i>My Profile</a></div>
            <div class="header-link"><a class="user-only-link" href="../login/logout.php"><i class="fa-solid fa-door-open"></i>Log Out</a></div>
        </div>
    </div>

    <div class="window main-window">
        <form action="" method="POST">
            <h2>Purchase</h2>
            <p>Select date and time</p>
            
            <input type="hidden" id="movie_id" name="movie_id" value="<?php echo $_SESSION['movie_id']?>"> 
            <div class="inline-wrapper">
                <div class="row-wrapper">
                    <div class="input-title">Date</div>
                    <input type="date" id="date" name="date" required>
                    <div class="error-msg"><?php echo isset($error_msg_date) ? $error_msg_date : ''; ?></div>
                </div> 

                <div class="row-wrapper">
                    <div class="input-title">Time</div>
                    <select id="time" name="time">
                        <option value="13:00">13:00</option>
                        <option value="16:30">16:30</option>
                        <option value="20:00">20:00</option>
                    </select>                  
                </div>
            </div>
            <button type="submit" name="submit" onclick="toSeatScreen()">Proceed</button> 
        </form>
    </div>
</body>

</html>