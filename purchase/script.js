function getSelectedSeats() {
    let selectedSeats = [];
    for (let i = 1; i <= 64; i++) {
       seat = document.getElementById(i);
        if (seat.classList.contains("selected")) {
            selectedSeats.push(seat.id);
        }
    }

    let seatInput = document.getElementById("seats");
    seatInput.value = selectedSeats;
}