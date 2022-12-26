
const apiKey = '94b6f6a8192762ed6a51bfc3dc86870d';
const resultsContainer = document.getElementById('movie-wrapper');
let select = document.getElementById('cat');


async function getMoviesByGenre(Id) {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&language=fr-FR&page=1&with_genres=${Id}`);
        const data = await response.json();

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

select.addEventListener("change", function (){
    let genreID = select.value;
    //console.log(genreID)
    getMoviesByGenre(genreID)
});