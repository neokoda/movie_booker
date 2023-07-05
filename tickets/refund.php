<?php
include '../login/config.php';
session_start();

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM user_data WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['password'] === $password) {
        $sql = "DELETE FROM bookings WHERE id = '{$_GET['ticket_id']}'"; // delete ticket info from database
        $result = mysqli_query($conn, $sql);

        $_SESSION['balance'] = $_SESSION['balance'] + $_GET['refund_price'];
        $sql = "UPDATE user_data SET balance = '{$_SESSION['balance']}'  WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        header("Location: ../purchase/success.html");
    } else {
        $error_msg_pw = "Wrong password.";
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
            <div class="header-link"><a href="../"><i class="fa-solid fa-house"></i>HOME</a></div>
            <div class="header-link"><a class="user-only-link" href="../tickets/"><i class="fa-solid fa-ticket"></i>TICKETS</a></div>
        </div> 
        <div class="header-part">
            <div class="header-link"><a class="user-only-link" href="../profile/"><i class="fa-solid fa-user"></i>MY PROFILE</a></div>
            <div class="header-link"><a class="user-only-link" href="../login/logout.php"><i class="fa-solid fa-door-open"></i>LOG OUT</a></div>
        </div>
    </div>

    <div class="window main-window" id="refund-window">
        <h2>Confirm Refund</h2>
        <form method="POST" action=''>
            <div class="wrapper">  
                    <div class="input-title">Password</div>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <div class="error-msg"><?php echo isset($error_msg_pw) ? $error_msg_pw : ''; ?></div>
            </div>
            <button type="submit" name="submit">Refund</button> 
        </form>
    </div>
</body>

</html>