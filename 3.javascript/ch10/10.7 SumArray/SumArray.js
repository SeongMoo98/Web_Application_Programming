function start(){
    var theArray = [1,2,3,4,5,6,7,8,9,10];
    var total1 = 0, total2 = 0;

    // Iterates through the elements of the array in order and
    // adds each element's value to total1
    var length = theArray.length;

    for(var i=0; i<length; i++){
        total1 += theArray[i];
    }

    var results = "<p>Total using indices : " + total1 +"</p>";

    for(var element in theArray){
        total2 += theArray[element];
    }

    results += "<p>Total using for ... in : " +total2 +"</p>";
    document.getElementById("output").innerHTML = results;
}

window.addEventListener("load", start, false);