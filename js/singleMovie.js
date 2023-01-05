const apiKey = '94b6f6a8192762ed6a51bfc3dc86870d';
let pId = document.getElementById('movieId');
const resultsContainer = document.getElementById('movie-wrapper');
let movieId = pId.textContent




async function getMovieById() {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=fr-FR`);
        const data = await response.json();



        resultsContainer.innerHTML = `
                <div class="h-screen flex flex-wrap">
                    <div class= "w-2/5 h-full flex items-center justify-center">
                        <img class="w-4/5 h-4/5 shadow-2xl" src="https://image.tmdb.org/t/p/w500/${data.poster_path}" alt="${data.title}">
                    </div>
                    <div class="flex flex-col w-3/5 h-screen items-center justify-center">
                        <h1 class="text-white font-bold w-4/5 text-3xl text-center">${data.title}</h1>
                        <p class="text-white w-4/5 text-center mt-5">${data.release_date}</p>
                        <p class="text-white w-4/5 text-center mt-5 text-2xl">${data.overview}</p>
                        <div class="w-full flex justify-evenly">
                            <div class="h-20 w-20 border-gray-600 rounded-full border-2">
                                <p class="text-white text-center mt-5 text-2xl">${data.vote_average}</p>
                            </div>
                            <p class="text-gray-600 text-center mt-5">Pour <span class=" font-bold text-white"> ${data.vote_count} </span> Votes</p>
                        </div>
                    </div>
                </div>
            `;
    } catch (error) {
        console.error(error);
    }
}



getMovieById()