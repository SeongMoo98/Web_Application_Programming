function start(){

    var a = [ 10, 1, 9, 2, 8, 3, 7, 4, 6, 5 ];

    outputArray("Data items in original order : ", a, 
        document.getElementById("originalArray"));

    a.sort(compareIntegers);

    outputArray("Data items in ascending order : ", a, 
        document.getElementById("sortedArray"));
}

function outputArray( heading, theArray, output ){
    output.innerHTML = heading + theArray.join(" ");
}

function compareIntegers(value1, value2){
    return parseInt(value1) - parseInt(value2);
}

window.addEventListener("load", start, false);