<?php

include '../login/config.php';

session_start();

$sql = "SELECT seats FROM bookings WHERE movie_id = '{$_SESSION['movie_id']}' AND date = '{$_SESSION['date']}' AND time = '{$_SESSION['time']}'";
$result = mysqli_query($conn, $sql);

$booked_seats = [];
while ($row = mysqli_fetch_assoc($result)) { 
    $seats = unserialize($row['seats']);
    $booked_seats = array_merge($booked_seats, $seats); 
}

if (isset($_GET['seats'])) {
    $selectedSeats = explode(',', $_GET['seats']);
    $_SESSION['seats'] = $selectedSeats;
    $ticketAmount = count($selectedSeats);
    if ($_GET['seats'] === '') { // check for valid seat booking
        $error_msg_amount = "You must book at least one seat.";
    }
    elseif ($ticketAmount > 6) {
        $error_msg_amount = "You are only allowed to book a maximum of 6 tickets at a time.";
    } 
    else {
        header("Location: ./confirm.php");
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

    <div id="seat-selection" class="window main-window">
        <h2>Select your seats</h2>  

        <div id="seat-details">
            <div class="seat-kind">
                <div class="color" id="red"></div>
                <div>Taken</div>
            </div>
            <div class="seat-kind">
                <div class="color" id="yellow"></div>
                <div>Selected</div>
            </div>
            <div class="seat-kind">
                <div class="color" id="green"></div>
                <div>Free</div>
            </div>
        </div>      

        <div id="screen">SCREEN</div>

        <div id="movie-seats">
            <script> // display correct color for each seat
                let movie_seats = document.getElementById("movie-seats");
                let booked_seats = <?php echo json_encode($booked_seats); ?>;

                for (let i = 1; i <= 64; i++) {
                    seat = document.createElement('div');
                    seat.id = i;
                    
                    if (booked_seats.indexOf(i.toString()) !== -1) {
                        seat.className = "seat taken";
                    } else {
                        seat.className = "seat free";
                        seat.addEventListener('click', function() {
                            if (this.className === "seat free") {
                                this.className = "seat selected";
                                getSelectedSeats();
                            } else {
                                this.className = 'seat free';
                                getSelectedSeats();
                            }
                        });
                    }

                    seat.innerHTML = i;

                    movie_seats.appendChild(seat);
                }
            </script>
        </div>

        <div id="continue">
            <form id="continue-only">
                <input type="hidden" name="seats" id="seats">
                <button type="submit" name="continue">Continue</button>
                <div class="error-msg"><?php echo isset($error_msg_amount) ? $error_msg_amount : ''; ?></div>
            </form>
        </div>
    </div>

</body>

</html>