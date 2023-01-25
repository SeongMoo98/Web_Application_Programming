function start(){

    var array1 = [  [1,2,3], 
                    [4,5,6] ];
    var array2 = [  [1,2],
                    [3],
                    [4,5,6] ];

    outputArray("Values in Array1 by row : ", array1,
        document.getElementById("output1"));
    
    outputArray("Values on array2 by row : ", array2,
        document.getElementById("output2"));
}

function outputArray( heading, theArray, output ){
    var result = "";

    for(var row in theArray){
        result += "<ol>";

        for(var column in theArray[row]){
            result += "<li>" + theArray[row][column] + "</li>";
        }

        result += "</ol>"
    }

    output.innerHTML = result;
}

window.addEventListener("load", start, false);