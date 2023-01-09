const apiKey = "94b6f6a8192762ed6a51bfc3dc86870d";

async function displayPopular(page) {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/popular?api_key=${apiKey}&page=${page}&language=fr-FR`);
        const data = await response.json();

        // Afficher les films dans la page web


        let resultsContainer;
        if (page == "1") {
            resultsContainer = document.getElementById("popularMovies");
        } else if (page == "2") {
            resultsContainer = document.getElementById("popularTv");
        }   else if (page == "3") {
            resultsContainer = document.getElementById("Discover")
        }   else if (page == "4") {
            resultsContainer = document.getElementById("Random")
        }


        resultsContainer.innerHTML = "";
        for (const movie of data.results) {
            resultsContainer.innerHTML += `
            
                <a href="movieSingle.php?id=${movie.id}">
                    <img src="https://image.tmdb.org/t/p/w500/${movie.poster_path}" alt="${movie.title}">
                </a>
            `;
        }
    } catch (error) {
        console.error(error);
    }
}

displayPopular(1);
displayPopular(2);
displayPopular(3);
displayPopular(4);

