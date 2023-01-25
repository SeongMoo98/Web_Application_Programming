// Fig. 15.25: XMLDOMTraversal.html 
// Traversing an XML document using the XML DOM. 
var outputHTML = ""; // stores text to output in outputDiv
var idCounter = 1; // used to create div IDs
var depth = -1; // tree depth is -1 to start
var current = null; // represents the current node for traversals
var previous = null; // represent prior node in traversals


// Register event handlers for buttons and load XML Document
function start(){
    document.getElementById("firstChild").
        addEventListener("click", processFirstChild, false);
    document.getElementById( "nextSibling" ).
        addEventListener( "click", processNextSibling, false );
    document.getElementById( "previousSibling" ).
        addEventListener( "click", processPreviousSibling, false );
    document.getElementById( "lastChild" ).
        addEventListener( "click", processLastChild, false );
    document.getElementById( "parentNode" ).
        addEventListener( "click", processParentNode, false );

    loadXMLDocument("article.xml");
}

// Load XML Document programmatically
function loadXMLDocument( url ){
    var xmlHttpRequest = new XMLHttpRequest();
    // XML Request를 통해 넘어온 XML 형식의 결과
    // 자동으로 DOM Parsing이 끝내고 Document 전체가 넘어온다
    xmlHttpRequest.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            buildHTML(this.responseXML.childNodes);
            displayDoc();
        }
    };
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

// set style of node with specified id
function setCurrentNodeStyle( id, highlight ){
    // 선택된 element를 highlight 설정
    document.getElementById( id ).className = 
        ( highlight ? "highlighted" : "" );
}

// Insert non-breaking spaces for indentation
function spaceOutput( number ){
    //공백 설정
    for(var i=0; i<number; i++){
        outputHTML += "&nbsp;&nbsp;&nbsp;";
    }
}
// Traverse XML Document and Build HTML5 representation of its content
function buildHTML( childList ){
    depth++;

    //Display each node's content  
    for(var i = 0; i < childList.length; i++){
        switch( childList[i].nodeType){
            case 1: {
                // Node.ELEMENT_NODE; value used for portability
                outputHTML += "<div id =\"id" + idCounter + "\">";
                spaceOutput( depth );
                outputHTML += childList[i].nodeName;
                idCounter++;
 
                // 현재 Node에 자식 Node가 있다면 recursion으로 처리
                if(childList[i].childNodes.length != 0)
                    buildHTML( childList[i].childNodes );
                outputHTML += "</div>";
                break;
            }
            case 3: case 8:{ // Node.TEXT_NODE, Node.COMMENT_NODE
                // 들여쓰기가 존재한다면
                if( childList[i].nodeValue.indexOf("   ") == -1 && 
                    childList[i].nodeValue.indexOf("      ") == -1)
                {
                    outputHTML += "<div id = \"id" + idCounter + "\">";
                    spaceOutput( depth );
                    outputHTML += childList[i].nodeValue + "</div>";
                    idCounter++;
                }
            }
        }
    }
    depth--;
}


// Display the XML Document and Highlight the first child
function displayDoc(){
    document.getElementById("outputDiv").innerHTML = outputHTML;
    current = document.getElementById("id1");
    setCurrentNodeStyle( current.getAttribute("id"), true );
}


// Highlight first child of current node
function processFirstChild(){
    //헌재 Node의 child의 수가 1 AND 그 child의 NodeType이 TEXT_NODE
    if (current.childNodes.length == 1 && 
            current.firstChild.nodeType == 3)
    {
        alert("There is no child node");
    }
    else if( current.childNodes.length > 1){
        previous = current;

        if( current.firstChild.nodeType != 3){
            current = current.firstChild;
        }
        else{ 
            // firstChild가 TEXT_NODE이지만
            // childNode가 더 존재할 때
            // nextSibling으로 이동 
            current = current.firstChild.nextSibling;
        }
        setCurrentNodeStyle( previous.getAttribute( "id" ), false );
        setCurrentNodeStyle( current.getAttribute( "id" ), true ); 
    }
    else{
        alert( "There is no child node" );
    }    
}

// Highlight next sibling of current node
function processNextSibling(){
    //현재 Node가 전체를 나타내는 outputDiv가 아니고
    // nextSibling이 존재할 때
    if(current.getAttribute("id") != "outputDiv" && current.nextSibling){
        previous = current;
        current = current.nextSibling;
        setCurrentNodeStyle(previous.getAttribute("id"), false);
        setCurrentNodeStyle(current.getAttribute("id"), true);
    }
    else{
        alert("There is no next sibling");
    }
}

// Highlight previous sibling of current node if it is not a text node
function processPreviousSibling(){
    //현재 Node가 전체를 나타내는 outputDiv가 아니고
    // nextSibling이 존재하고
    // 그 Sibling이 TEXT_NODE가 아닐 때
    if ( current.getAttribute( "id" ) != "outputDiv" && 
        current.previousSibling && current.previousSibling.nodeType != 3 )
    {
        previous = current; // save currently highlighted node
        current = current.previousSibling; // get new current node
        setCurrentNodeStyle( previous.getAttribute( "id" ), false );
        setCurrentNodeStyle( current.getAttribute( "id" ), true );
    }
   else 
      alert( "There is no previous sibling" );
}

// Highlight last child of current node
function processLastChild()
{
   if ( current.childNodes.length == 1 && current.lastChild.nodeType == 3 ){
      alert( "There is no child node" );
   } 
   else if ( current.childNodes.length != 0 ) {
      previous = current; // save currently highlighted node
      current = current.lastChild; // get new current node
      setCurrentNodeStyle( previous.getAttribute( "id" ), false ); 
      setCurrentNodeStyle( current.getAttribute( "id" ), true );
   }
   else 
      alert( "There is no child node" );
}

// highlight parent of current node
function processParentNode()
{   
    // ParentNode가 body가 아니다.
    if ( current.parentNode.getAttribute( "id" ) != "body" ) {
        previous = current; // save currently highlighted node
        current = current.parentNode; // get new current node
        setCurrentNodeStyle( previous.getAttribute( "id" ), false ); 
        setCurrentNodeStyle( current.getAttribute( "id" ), true );
    }
   else 
      alert( "There is no parent node" );
}

window.addEventListener("load",start, false);