<?php

session_start();
include '../login/config.php';

if (isset($_POST['submit'])) {
    $username = $_SESSION['username']; 
    $password = $_POST['password']; 
    $new_password = $_POST['new-password']; 
    $cfirm_password = $_POST['confirm-new-password'];
    
    $sql = "SELECT * FROM user_data WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
 
    if (!($cfirm_password === $new_password) and (!(empty($cfirm_password)) and !(empty($new_password)))) {
        $error_msg_cfirm = 'New passwords do not match.'; 
    }
    elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $new_password)) { // check if new password matches strong password regex
        $error_msg_new = 'New password has to have at least 8 characters, a lowercase and an uppercase letter, a digit, and a special character.';
    } 
    else {
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] === $password) {
                $sql = "UPDATE user_data SET password = '$new_password' WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);

                header("Location: ./success.html"); // go to success page
            }
            else {
                $error_msg_pw = "Wrong password!";
            }
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
    <div class="window main-window" id="change-pw">
        <form action="" method="POST">
            <h2>Change Password</h2>
            <div class="wrapper">
                <div class="input-title">Current Password</div>
                <input type="password" name="password" id="password" placeholder="Enter current password" required>
                <div class="error-msg"><?php echo isset($error_msg_pw) ? $error_msg_pw : ''; ?></div>
            </div>
            <div class="wrapper">  
                <div class="input-title">New Password</div>
                <input type="password" name="new-password" id="new-password" placeholder="Enter new password" required>
                <div class="error-msg"><?php echo isset($error_msg_new) ? $error_msg_new : ''; ?></div>
            </div>
            <div class="wrapper">  
                <div class="input-title">Confirm Password</div>
                <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="Reenter new password" required>
                <div class="error-msg"><?php echo isset($error_msg_cfirm) ? $error_msg_cfirm : ''; ?></div>
            </div>
            <div class="wrapper">
                <button name="submit" value="">Confirm</button>
            </div>
        </form>
    </div>
</body>
</html>
