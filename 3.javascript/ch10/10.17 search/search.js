
var a = new Array(100);

for(var i = 0; i < a.length; i++){
    a[i] = 2*i;
}

function buttonPressed(){
    // Get the input text field
    var inputVal = document.getElementById("inputVal");
    // Get the result paragraph
    var result = document.getElementById("result");

    var searchKey = parseInt(inputVal.value);
    var element = a.indexOf(searchKey);

    if( element != -1 ){
        result.innerHTML = "Found value in element " + element;
    }
    else{
        result.innerHTML = "Value not Found";
    }
}

function start(){
    var searchButton = document.getElementById("searchButton");
    searchButton.addEventListener("click", buttonPressed, false);
}

window.addEventListener("load", start, false);