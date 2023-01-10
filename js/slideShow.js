let i = 0;
const images = ['image/spiderman.jpg', 'image/avatar.jpg', 'image/chat.jpg', 'image/dune.jpg'];
const time = 3000;



function changeImg(){

    document.getElementById('slideShow').src = images[i];

    if(i < images.length - 1) {
        i++
    }   else {
        i = 0
    }
    setTimeout("changeImg()", time);
}

window.onload=changeImg;