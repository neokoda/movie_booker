<?php

include 'config.php';
error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_data WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] === $password) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['balance'] = $row['balance'];
            $_SESSION['birth_date'] = $row['birth_date'];
            $_SESSION['age'] = calculateAge($_SESSION['birth_date']);
            header("Location: ../");
        } else {
            $error_msg_pw = "Wrong password.";
        }
    } else {  
        $error_msg_uname = "Username doesn't exist";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>SEA Cinema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div id="login-message">Login</div>
    <div> 
        <form action="" method="POST">
            <div>
                <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
                <div class="error-msg"><?php echo isset($error_msg_uname) ? $error_msg_uname : ''; ?></div>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
                <div class="error-msg"><?php echo isset($error_msg_pw) ? $error_msg_pw : ''; ?></div>
            </div>
            <div>Don't have an account? <a href="register.php">Register</a></div>
            <div>
                <button name="submit">Submit</button>
            </div>
        </form>
    </div>


</body>
