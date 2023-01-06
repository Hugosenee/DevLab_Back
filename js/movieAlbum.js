console.log(movieIdsStr)
let movieIdsArray = JSON.parse(movieIdsStr);
const apiKey = "94b6f6a8192762ed6a51bfc3dc86870d";
const resultsContainer = document.getElementById('movie-wrapper');

async function getMovieFromAlbum(movId) {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/${movId}?api_key=${apiKey}&language=fr-FR`);
        const data = await response.json();
        if (sessionId === creatorId) {

        resultsContainer.innerHTML += `
                <a href="movieSingle.php?id=${data.id}">
                        <img class="w-32" src="https://image.tmdb.org/t/p/w500/${data.poster_path}" alt="${data.title}">
                        <a href="deleteMovieFromAlbum.php?id=${data.id}">Supprimer</a>
                </a>
            `;
        } else {
            resultsContainer.innerHTML += `
                <a href="movieSingle.php?id=${data.id}">
                        <img class="w-32" src="https://image.tmdb.org/t/p/w500/${data.poster_path}" alt="${data.title}">
                </a>
            `;
        }
    } catch (error) {
        console.error(error);
    }
}

if (movieIdsArray.length > 0 ){
    for (let i = 0; i < movieIdsArray.length; i++) {
        const movieId = movieIdsArray[i];
        getMovieFromAlbum(movieId)
    }
} else {
    resultsContainer.innerHTML += `<p class="text-white">L'album est vide</p>`
}