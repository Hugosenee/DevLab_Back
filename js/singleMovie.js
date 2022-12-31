const apiKey = '94b6f6a8192762ed6a51bfc3dc86870d';
let pId = document.getElementById('movieId');
const resultsContainer = document.getElementById('movie-wrapper');
let movieId = pId.textContent




async function getMovieById() {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=fr-FR`);
        const data = await response.json();



        resultsContainer.innerHTML = `
               <h1 class="text-white">${data.title}</h1>
               <p class="text-white">${data.release_date}</p>
               <img src="https://image.tmdb.org/t/p/w500/${data.backdrop_path}" alt="${data.title}">
               <img src="https://image.tmdb.org/t/p/w500/${data.poster_path}" alt="${data.title}">
               <p class="text-white">${data.overview}</p>

               
            `;
    } catch (error) {
        console.error(error);
    }
}



getMovieById()