async function getMovies() {
    try {
        const response = await fetch('https://seleksi-sea-2023.vercel.app/api/movies');
        const movieData = await response.json();

        for (let i = 0; i < movieData.length; i++)  {
            let title = movieData[i]["title"];
            let poster_url = movieData[i]["poster_url"];
            let price = movieData[i]["ticket_price"];
            let age_rating = movieData[i]["age_rating"];
        
            catalog = document.getElementById('movie-catalog');
            newDiv = document.createElement('div');
            newDiv.className = "movie";
            newDiv.id = i;
            catalog.appendChild(newDiv);
        
            newImg = document.createElement('img');
            newImg.src = poster_url;
            newImg.onclick = function () {
                movieInfo(i, price, age_rating, title);
            };
        
            newDiv2 = document.createElement('div');
            newDiv2.className = "movie-title";
            newDiv2.innerHTML = title;
        
            newBtn = document.createElement('button');
            newBtn.innerHTML = "Buy a Ticket";
        
            id = document.getElementById(i); 
            
            id.appendChild(newImg);
            id.appendChild(newDiv2);
        }   
    } catch (error) {
    console.error(error);
}
}

async function movieInfo(movieId, price, age_rating, title) {
    try {
        let url = "movie-info/?id=" + movieId + "&price=" + price + "&age_rating=" + age_rating + "&title=" + title; 
        window.location.href = url;

        } catch (error) {
            console.error(error);
        }
    } 

getMovies();

function checkLoadGuestMode(isLoggedIn) {
    if (!isLoggedIn) {
        let links = document.getElementsByClassName('user-only-link');
        for (let i = 0; i < links.length; i++) {
            let link = links[i];
            link.href = "./login/login.php";
        }
    }
}

