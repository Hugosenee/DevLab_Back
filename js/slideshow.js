let i = 0;
const images = ['image/spiderman.jpg', 'image/avatar.jpg', 'image/dune.jpg', 'image/chat.jpg'];
const time = 3000;
const slide = document.getElementById('slideShow');


function changeImg(){

    slide.src = images[i];

    if(i < images.length - 1) {
        i++
    }   else {
        i = 0
    }
    setTimeout("changeImg()", time);
}

window.onload=changeImg;