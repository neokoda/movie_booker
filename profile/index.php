<?php

include '../login/config.php';
session_start();

if (isset($_POST['submit'])) {
    $amount = intval($_POST['amount']);
    $password = $_POST['password'];
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM user_data WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if ($row['password'] === $password) {
            if (!preg_match('/^[0-9]+$/', ($_POST['amount']))) {
                $error_msg_amount = "Invalid topup value. Please only inlcude numbers.";
            } 
            elseif ($_POST['submit'] === "withdraw") {
                if ($row['balance'] < ($amount)) {
                    $error_msg_amount = "Insufficient balance.";
                } elseif (($amount) > 500000) {
                    $error_msg_amount = "Maximum amount for each withdrawal is Rp500.000.";
                } else {
                    $_SESSION['balance'] = $row['balance'] - $amount;
                    $sql = "UPDATE user_data SET balance = '{$_SESSION['balance']}' WHERE username='{$_SESSION['username']}'";
                    mysqli_query($conn, $sql);
                    $success_msg = "Balance successfully updated!";
                }
            }   

            elseif ($_POST['submit'] === "topup") {
                $_SESSION['balance'] = $row['balance'] + $amount;
                $sql = "UPDATE user_data SET balance = '{$_SESSION['balance']}' WHERE username='{$_SESSION['username']}'";
                mysqli_query($conn, $sql);
                $success_msg = "Balance successfully updated!";
            }

        } else {
            $error_msg_pw = "Wrong password.";
        }
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
</head>

<body>
    <div id="nav-header">   
        <div class="header-part">
            <div class="header-link"><a href="../"><i class="fa-solid fa-house"></i>Home</a></div>
            <div class="header-link"><a class="user-only-link" href="../tickets/"><i class="fa-solid fa-ticket"></i>Tickets</a></div>
        </div> 
        <div class="header-part">
            <div class="header-link"><a class="user-only-link" href=""><i class="fa-solid fa-user"></i>My Profile</a></div>
            <div class="header-link"><a class="user-only-link" href="../login/logout.php"><i class="fa-solid fa-door-open"></i>Log Out</a></div>
        </div>
    </div>

    <div id="main" class="window main-window">
        <div id="content">
            <h1>My Profile</h1>
            <ul>
                <li id="username"><?php echo "Username: " . $_SESSION['username']?></li>
                <li id="birth_date"><?php echo "Date of Birth: " . $_SESSION['birth_date']?></li>
                <li id="age"><?php echo "Age: " . ($_SESSION['age'])?></li>
                <li id="balance"><?php echo "Balance: Rp" . $_SESSION['balance']?></li>
            </ul>
            <form action='./change_password.php'>
                <button>Change password</button>
            </form> 
        </div>

        <div id="topup-or-withdraw" class="window">
            <form action="" method="POST" id="topup">
                <h2>Top Up / Withdraw</h2>
                <div class="wrapper">
                    <div class="input-title">Amount</div>
                    <input type="text" name="amount" id="amount" placeholder="Enter amount" required>
                    <div class="error-msg"><?php echo isset($error_msg_amount) ? $error_msg_amount : ''; ?></div>
                </div>
                <div class="wrapper">  
                    <div class="input-title">Password</div>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <div class="error-msg"><?php echo isset($error_msg_pw) ? $error_msg_pw : ''; ?></div>
                </div>
                <div class="wrapper">
                    <button name="submit" value="topup">Top up</button>
                    <button name="submit" value="withdraw">Withdraw</button>
                    <div class="success-msg"><?php echo isset($success_msg) ? $success_msg : ''; ?></div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>