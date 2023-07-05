<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "movie_booker";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Failed to connect to database.')</script>");
}

function calculateAge($birthdate) {
    $birthdate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;
    return $age;
}

?>