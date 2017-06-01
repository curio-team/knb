/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Pusher.log = function(message) {
    if (window.console && window.console.log) {
        window.console.log(message);
    }
};

// This doesn't work
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '8f5d535785d154b591eb',
//     cluster: 'eu',
//     encrypted: true
// });
//
// window.Echo.channel('houseSelection')
//     .listen('housesSelected', function(e){
//         console.log('why is this not receiving');
//         console.log(e);
//     });

// This does work:
var pusher = new Pusher('8f5d535785d154b591eb', {
    cluster: 'eu',
    encrypted: true
});

var channel = pusher.subscribe('houseSelection');
channel.bind('housesSelected', function() {
    setPrinting(true);
});

/*
    Visual elements
*/
var canvas = document.getElementById('printerCanvas');
var ctx = canvas.getContext('2d');
var printerBottomImage = document.getElementById('printerBottomImage');
var printerTopImage = document.getElementById('printerTopImage');
var printerPaperImage = document.getElementById('printerPaperImage');
var emblemImage = document.getElementById('emblemImage');
var canvasW = canvas.width;
var canvasH = canvas.height;
var isPrinting = false;
var maxPrintPos = 270;
var paperY = 0;
var nextPrint = 0;
var nextPrintInterval = 250;
var jumping = true;
var printJump = 5;
var emblemW = 135;
var emblemH = 186;
var emblemNowH = 0;

function setPrinting(printing){
    isPrinting = printing;
}

function getTime(){
    return new Date().getTime();
}

// The drawing and printing function
function update() {
    window.requestAnimationFrame(update);

    ctx.clearRect(0, 0, canvasW, canvasH);

    //
    if(isPrinting && ((jumping && nextPrint < getTime()) || !jumping)){
        if(jumping){
            nextPrint = getTime() + nextPrintInterval;
            paperY += printJump;
        }else{
            paperY++;
        }

        if(jumping && paperY > 170){
            jumping = false;
        }

        if(paperY > maxPrintPos){
            isPrinting = false;
        }

        emblemNowH = 1 - (1 / (emblemH / (maxPrintPos - paperY)));
    }

    ctx.drawImage(printerBottomImage, 0, 0, 379, 500);
    ctx.drawImage(printerPaperImage, 0, paperY, 379, 255);
    ctx.drawImage(emblemImage,
        // sourceX, sourceY (where on the image do we start sampling from)
        0, emblemImage.height - (emblemImage.height * emblemNowH),

        // sourceW, sourceH (for what width and height do we sample)
        emblemImage.width, emblemImage.height * emblemNowH,

        // X, Y (where do we draw)
        120, 280,

        // W, H (what width and height do we draw)
        emblemW, emblemH * emblemNowH);
    ctx.drawImage(printerTopImage, 0, 0, 379, 500);
}

window.requestAnimationFrame(update);