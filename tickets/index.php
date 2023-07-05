<?php

include '../login/config.php';
session_start();

$username = $_SESSION['username'];
$sql = "SELECT * FROM bookings WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (isset($_GET['submit'])) {
    header("Location: ./refund.php");
}

echo '<div id="ticket-catalog">';
while ($row = mysqli_fetch_assoc($result)) { // display info for each ticket
    
    echo '<div class="ticket window">';
    echo '<div>';
    echo '<h1>' . $row['title'] . '</h1>';
    echo '<ul>';
    echo '<li>Ticket ID: '. $row['id'] . '</li>';
    echo '<li>Owner: '. $row['username'] .' </li>';
    echo '<li>Date: ' . $row['date'] .  '</li>';
    echo '<li>Time: ' . $row['time'] . '</li>';
    echo '<li>Seat ID(s): ' . implode(' ,', unserialize($row['seats'])) . '</li>';
    echo '<li>Price: ' . $row['price'] . '</li>';
    echo '</ul>';
    echo '</div>';
    echo '<form action="refund.php">';
    echo '<input type="hidden" name="refund_price" value=' . $row['price'] . '>';
    echo '<button type="submit" name="ticket_id" value=' . $row['id'] . '>';
    echo 'Refund';
    echo '</button>';
    echo '</form>';
    echo '</div>';
}
echo '</div>'

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
</body>

</html>