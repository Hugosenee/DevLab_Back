const burgerBtn = document.getElementById('burgerBtn')
const closeBtn = document.getElementById('closeBtn')
const nav = document.getElementById('nav')

burgerBtn.addEventListener('click', function (){
    nav.classList.remove('max-[425px]:hidden')
})

closeBtn.addEventListener('click', function (){
    nav.classList.add('max-[425px]:hidden')
})