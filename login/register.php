<?php

include 'config.php';
error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: ../main_page.html");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $cfirm_password = $_POST['cfirm_password'];
    $birth_date = $_POST['birth_date'];
    $_SESSION['age'] = calculateAge($birth_date);
    $_SESSION['balance'] = 0;
    $_SESSION['birth_date'] = $birth_date;
    $current_date = new DateTime(); 
    $birthdate = DateTime::createFromFormat('Y-m-d', $birth_date);
    
    $sql = "SELECT * FROM user_data WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $username)) {
        $invalid_uname_msg = 'Invalid username. Make sure not to start with a number and only include 6-32 alphanumeric characters .';
    } 
    elseif (!($cfirm_password === $password) and (!(empty($cfirm_password)) and !(empty($password)))) {
        $invalid_cfirm_msg = 'Passwords do not match.';
    }
    elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
        $invalid_pw_msg = 'Password has to have at least 8 characters, a lowercase and an uppercase letter, a digit, and a special character.';
    } 
    elseif ($birthdate > $current_date) {
        $invalid_birthdate_msg = 'Birth date must be before the current date.';
    }
    else {
        if (!($result->num_rows > 0)) {
            $sql = "INSERT INTO user_data (username, password, birth_date, balance) VALUES ('$username', '$password', '$birth_date', 0)";
            $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Registration successful!')</script>";
        } else {
            echo "<script>alert('Something went wrong.')</script>";
        }
        $_SESSION['username'] = $username;
        
        header ("Location: ../");
    } else {
        $invalid_uname_msg = 'Username already taken!';
    }
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
    <div id="login-message">Register</div>
    <div> 
        <form action="" method="POST">
            <div>
                <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
                <div class="error-msg"><?php echo isset($invalid_uname_msg) ? $invalid_uname_msg : ''; ?></div>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
                <div class="error-msg"><?php echo isset($invalid_pw_msg) ? $invalid_pw_msg : ''; ?></div>
            </div>
            <div>
                <input type="password" id="cfirm_password" name="cfirm_password" placeholder="Confirm password" value="<?php echo isset($_POST['cfirm_password']) ? $_POST['cfirm_password'] : ''; ?>" required>
                <div class="error-msg"><?php echo isset($invalid_cfirm_msg) ? $invalid_cfirm_msg : ''; ?></div>
            </div>
            <div>
                <p>Date of Birth:</p>
                <input type="date" id="birth_date" name="birth_date" placeholder="Date of birth" value="<?php echo isset($_POST['birth_date']) ? $_POST['birth_date'] : ''; ?>" required>
                <div class="error-msg"><?php echo isset($invalid_birthdate_msg) ? $invalid_birthdate_msg : ''; ?></div>
            </div>
            <div>Already have an account? <a href="login.php">Log in</a></div>
            <div>
                <button name="submit">Submit</button>
            </div>
        </form>
    </div>

</body>
