var i = 0;
var images = ['image/spiderman.jpg', 'image/avatar.jpg', 'image/dune.jpg', 'image/chat.jpg'];
var time = 3000;
var slide = document.getElementById('slideShow');


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