async function displayInfo() {
    try {
        const response = await fetch('https://seleksi-sea-2023.vercel.app/api/movies'); // connecting to api and getting movie info
        const movieData = await response.json();

        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let movieId = urlParams.get('id');

        let title = movieData[movieId]["title"];
        let release_date = movieData[movieId]["release_date"];
        let age_rating = movieData[movieId]["age_rating"];
        let desc = movieData[movieId]["description"]; 
        let poster_url = movieData[movieId]["poster_url"];
        let ticket_price = movieData[movieId]["ticket_price"];

        document.getElementById("movie-title").innerHTML =  title;
        document.getElementById("desc").innerHTML = desc;
        document.getElementById("release-date").innerHTML = "Release date: " + release_date;
        document.getElementById("age-rating").innerHTML = "Age rating: " + age_rating;
        document.getElementById("price").innerHTML = "Ticket price: " + ticket_price;
        document.getElementById("movie-img").src = poster_url;
        

        } catch (error) {
            console.error(error);
        }
    } 

async function toPurchaseScreen() { // transferring movie id info to purchase section
    try { 
        let queryString = window.location.search;
        let params = new URLSearchParams(queryString);
        let id = params.get("id");  
        let url = "../purchase/?id=" + id;
        window.location.href = url;

        } catch (error) {
            console.error(error);
        }
    } 

function checkLoadGuestMode(isLoggedIn) { // modifying header links if user is in guest mode
    if (!isLoggedIn) {
        let links = document.getElementsByClassName('user-only-link');
        for (let i = 0; i < links.length; i++) {
            let link = links[i];
            link.href = "../login/login.php";
        }
    }
}

displayInfo();