const apiKey = "94b6f6a8192762ed6a51bfc3dc86870d";

async function displayPopular() {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/popular?api_key=${apiKey}&page=1&language=fr-FR`);
        const data = await response.json();

        // Afficher les films dans la page web


        let resultsContainer;
        resultsContainer = document.getElementById("popularMovies");


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
async function displayPopular2() {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/popular?api_key=${apiKey}&page=2&language=fr-FR`);
        const data = await response.json();

        // Afficher les films dans la page web


        let resultsContainer;
        resultsContainer = document.getElementById("popularTv");


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
async function displayPopular3() {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/popular?api_key=${apiKey}&page=3&language=fr-FR`);
        const data = await response.json();

        // Afficher les films dans la page web


        let resultsContainer;
        resultsContainer = document.getElementById("Discover");


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
displayPopular();
displayPopular2();
displayPopular3();