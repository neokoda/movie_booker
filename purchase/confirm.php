<?php
include '../login/config.php';
session_start();
$total_price = intval($_SESSION['price']) * count($_SESSION['seats']); // count total price

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $username = $_SESSION['username'];
    
    $sql = "SELECT * FROM user_data WHERE username='{$_SESSION['username']}'";
    $result = mysqli_query($conn, $sql);
    $serialized_seats = serialize($_SESSION['seats']); // serialize seat to store in sql database
    
    if ((intval($_SESSION['balance']) - $total_price) < 0) {
        $error_msg_amount = "Insufficient balance.";
    }
    elseif ($result->num_rows > 0) { 
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] === $password) { // handle new ticket booking
            $username = $_SESSION['username'];
            $movieId = $_SESSION['movie_id'];
            $title = mysqli_real_escape_string($conn ,$_SESSION['title']); // handle special characters in the title
            $date = $_SESSION['date'];
            $time = $_SESSION['time'];

            $sql = "INSERT INTO bookings (username, movie_id, title, `date`, `time`, seats, price) VALUES ('$username', '$movieId',  '$title', '$date', '$time', '$serialized_seats', '$total_price')";
            $result = mysqli_query($conn, $sql); // store in sql

            $deduced_balance = intval($_SESSION['balance']) - $total_price;
            $_SESSION['balance'] = $deduced_balance;
            
            $sql = "UPDATE user_data SET balance = '$deduced_balance' WHERE username='$username'";
            $result = mysqli_query($conn, $sql);


            header("Location: ./success.html");
        } else {
            $error_msg_pw = "Wrong password.";
        }
    }
}
?>

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
        <form action="" method="POST" id="confirm">
            <h2>Confirm Payment</h2>
            <p id="user-balance"><?php echo"Your balance: Rp" . $_SESSION['balance']?></p>
            <ul id="ticket-info">
                <li><?php echo "Date: " . $_SESSION['date'];?></li>
                <li><?php echo "Time: " . $_SESSION['time'];?></li>
                <li><?php echo "Seat(s): "  . implode(', ', $_SESSION['seats']) ;?></li>
                <li><?php echo "Price: Rp" . strval($total_price);?></li>
            </ul>
            <div class="wrapper">  
                <div class="input-title">Password</div>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <div class="error-msg"><?php echo isset($error_msg_pw) ? $error_msg_pw : ''; ?></div>
                <div class="error-msg"><?php echo isset($error_msg_amount) ? $error_msg_amount : ''; ?></div>
            </div>
            <button type="submit" name="submit">Purchase</button> 
        </form>
    </div>

</body>

</html>
