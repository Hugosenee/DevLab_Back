const url = 'https://api.themoviedb.org/3';
const api_key = 'api_key=94b6f6a8192762ed6a51bfc3dc86870d';
const movie_pop_request = url + '/movie/popular?page=1&' + api_key;
const tv_pop_request = url + '/movie/popular?page=1&' + api_key;

const mTrendWrappper = document.getElementById('movie-trend-wrapper');
//const tTrendWrappper = document.getElementById('tv-trend-wrapper');


fetch(movie_pop_request)
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        console.log(data);

        let div = document.createElement('div');
        let img = document.createElement('img');
        let title = document.createElement('h1');

        div.classList.add('w-40', 'h-48', 'rounded-2xl', 'flex', 'flex-col', 'justify-center')
        img.src = `${data.backdrop_path}`;
        title.innerHTML = `${data.original_title}`;

        div.appendChild(mTrendWrappper);
        img.appendChild(div);
        title.appendChild(div);


    })
    .catch(function(error) {
        console.log(error);
    });

