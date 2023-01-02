<<<<<<< HEAD
let searchBar = document.getElementById('searchBar');


axios.get('https://api.themoviedb.org/3/search/multi?api_key=94b6f6a8192762ed6a51bfc3dc86870d&language=en-US&page=1&include_adult=false&query=the walking dead')
.then((res) => console.log(res))
.catch((err) => console.log(err))

searchBar.addEventListener("change", function (){
    console.log(searchBar.value)
});
=======
let searchP = document.getElementById('searchResult');
let searchResult = searchP.textContent;
let query = 'https://api.themoviedb.org/3/search/multi?api_key=94b6f6a8192762ed6a51bfc3dc86870d&language=en-US&page=1&include_adult=false&query='+ searchResult

/*
axios.get(query)
    .then((res) => console.log(res))
    .catch((err) => console.log(err))
*/
axios.get(query)
    .then((res) => {
        let data = res.data; // récupération des données de la réponse
        let displayElement = document.getElementById('results'); // élément DOM où afficher les données
        displayElement.innerHTML = ''; // on vide l'élément avant d'ajouter du contenu

        for (let result of data.results) {
            // pour chaque élément de la réponse, on crée un nouvel élément HTML
            // et on ajoute du contenu à l'aide de l'objet item
            let newElement = document.createElement('div');
            newElement.innerHTML = `
                <a href="movieSingle.php?id=${result.id}">
                             <img class="w-32 h-72" src="https://image.tmdb.org/t/p/w500/${result.poster_path}" alt="${result.title}">
                </a>
            `;
            displayElement.appendChild(newElement); // on ajoute l'élément au DOM
        }
    })
    .catch((err) => console.log(err))
>>>>>>> hugo
