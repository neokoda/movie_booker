# sea-cinema

## About The Project
This project was created as a requirement for enrolling in COMPFEST's Software Engineering Academy. It is a movie ticket booking app that allows users to explore through a wide selection of movies and book tickets. The app includes features in the mandatory phase and the challenge phase.

### Built with
The technologies used in this app are:
- HTML
- CSS
- Javascript
- PHP 
- MySQL 

This app also uses icons from [Font Awesome](https://fontawesome.com).

## Features

### User registration / login / logout
Users register by entering their username, password, and age (the page asks for their birth date so their age can be constantly updated). Each input components are validated before being saved to the database. The user is then redirected to the main page. Registered users can login by entering their username and password. Users can log out once they're done with their session. Unregistered users can still view movies and their description but they can't buy tickets or access user-only features (viewing tickets, changing their balance).

### Movie booking process
Users view movies from the main page, then they can click on the movie they want to watch. A new page with the description of the movie and a button to buy a ticket will be loaded. If the users are old enough, they will be redirected to select the date (has to be in the future), time (users can choose between 13:00, 16:30, and 20:00 for each movie), and their seats. Users can only book 6 seats at a time.
Then, they will be asked to confirm the booking by entering their password. After entering the correct password, users can see their ticket history in the "Tickets" page. They can also refund their tickets.

### User balance
Users can top up or withdraw their balance in the "My Profile" page. The amount is validated first. Users cannot enter anything other than digits and the most they can withdraw is min(500000, current_balance).

### Extra features
Users who want to change their password can by going to the "My Profile" page and clicking on the "Change password" button.
