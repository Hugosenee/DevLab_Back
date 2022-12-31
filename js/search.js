let searchBar = document.getElementById('searchBar');


axios.get('https://api.themoviedb.org/3/search/multi?api_key=94b6f6a8192762ed6a51bfc3dc86870d&language=en-US&page=1&include_adult=false&query=the walking dead')
.then((res) => console.log(res))
.catch((err) => console.log(err))

searchBar.addEventListener("change", function (){
    console.log(searchBar.value)
});