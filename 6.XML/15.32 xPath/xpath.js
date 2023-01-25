// Fig. 15.33: xpath.html 
// JavaScript that uses XPath to locate nodes in an XML document. 
var doc; // variable to reference the XML document
var outputHTML = ""; // stores text to output in outputDiv

//Register event handler for button and load XML document
function start(){
    document.getElementById("matchesButton").
        addEventListener("click", processXPathExpression, false);
    loadXMLDocument("sports.xml");
}

function loadXMLDocument( url ){
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            doc = this.responseXML;
        }
    };
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

function displayHTML(){
    document.getElementById("outputDiv").innerHTML = outputHTML;
}

// Obtain and apply XPath expression
function processXPathExpression(){
    var xpathExpression = document.getElementById("inputField").value;
    var result;
    outputHTML = "";

    // Internet Explorer
    if(!doc.evaluate){
        result = doc.selectNodes( xpathExpression );

        for(var i=0; i < result.length; i++){
            outputHTML += "<p>" + result.item( i ).text + "</p>";
        }
    }
    else{
        //XPath 구문을 넘겨줘서 그대로 실행한 결과는 Return
        result = doc.evaluate( xpathExpression, doc, null, 
            XPathResult.ORDERED_NODE_ITERATOR_TYPE, null );
        
        //처음 결과를 선택하기 위해 처음에 Next를 해준다
        var current = result.iterateNext();
        
        while( current ){
            // 선택된 element 내부에 있는 Text를 모두 가져온다
            outputHTML += "<p>" + current.textContent + "</p>";  
            current = result.iterateNext();
        }
    }
    displayHTML();
}

window.addEventListener("load", start, false);