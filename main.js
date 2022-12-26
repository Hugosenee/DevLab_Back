
const apiKey = "94b6f6a8192762ed6a51bfc3dc86870d";

async function displayPopularMovies() {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/popular?api_key=${apiKey}&page=1&language=fr-FR`);
        const data = await response.json();
        // Afficher les films dans la page web
        const resultsContainer = document.getElementById("results");
        resultsContainer.innerHTML = "";
        for (const movie of data.results) {
            resultsContainer.innerHTML += `
              <img class="w-32 h-72 object-cover rounded-2xl" src="https://image.tmdb.org/t/p/w500/${movie.poster_path}" alt="${movie.title}">
            `;
        }
    } catch (error) {
        console.error(error);
    }
}
displayPopularMovies()