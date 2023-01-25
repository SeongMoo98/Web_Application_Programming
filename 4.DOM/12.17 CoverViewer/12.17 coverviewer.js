// Fig. 12.5: coverviewer.js 
// Script to demonstrate dynamic styles used for animation. 
var interval = null; // keeps track of the interval
var speed = 6; // determines the speed of the animation
var count = 0; // size of the image during the animation


// called repeatedly to animate the book cover
function run(){

    count += speed;

    // stop the animation when the image is large enough
    if(count >= 375){
        window.clearInterval(interval);
        interval = null;
    }

    var bigImage = document.getElementById("imgCover");
    bigImage.setAttribute("style", "width : " + (0.7656 * count + "px;") +
        "height : " + (count + "px;"));
}

// inserts the proper image into the main image area and
// begins the animation
function display(imgfile){
    if( interval )
        return;

    var bigImage = document.getElementById("imgCover");
    bigImage.setAttribute("style", "width : 0px; height : 0px;");
    bigImage.setAttribute("src", "fullsize/"+imgfile);
    bigImage.setAttribute("alt", "Large version of " + imgfile);

    count = 0;
    
    //animation
    interval = window.setInterval("run()", 10);
}

function start() {
    document.getElementById( "jhtp" ).addEventListener(
        "click", function() { display( "jhtp.jpg" ); }, false );
    document.getElementById( "iw3htp" ).addEventListener(
        "click", function() { display( "iw3htp.jpg" ); }, false );
    document.getElementById( "cpphtp" ).addEventListener(
        "click", function() { display( "cpphtp.jpg" ); }, false );
    document.getElementById( "jhtplov" ).addEventListener(
        "click", function() { display( "jhtplov.jpg" ); }, false );
    document.getElementById( "cpphtplov" ).addEventListener(
        "click", function() { display( "cpphtplov.jpg" ); }, false );
    document.getElementById( "vcsharphtp" ).addEventListener(
        "click", function() { display( "vcsharphtp.jpg" ); }, false );
}

window.addEventListener("load", start, false);