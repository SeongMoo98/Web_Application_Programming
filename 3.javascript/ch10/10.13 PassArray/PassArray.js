function start(){
    
    var a = [ 1, 2, 3, 4, 5 ];
    
    // Passing entire array
    outputArray("Original Array : ", a,
        document.getElementById("originalArray"));

    modifyArray(a);

    outputArray("Modified Array : ", a, 
        document.getElementById("modifiedArray"));

    // Passing individual array element
    document.getElementById("originalElement").innerHTML =
        "a[3] before modifyElement : " + a[3];
    modifyElement(a[3]);
    document.getElementById("modifiedElement").innerHTML =
        "a[3] after modifyElement : " + a[3];
}

function outputArray( heading, theArray, output ){
    output.innerHTML = heading + theArray.join( " " ); 
}

function modifyArray( theArray ){
    for(var j in theArray){
        theArray[j] *= 2;
    }
}

function modifyElement( e ){
    e *= 2;
    document.getElementById("inModifyElement").innerHTML = 
        "Value in modifyElement : "+ e;
}

window.addEventListener("load", start, false);