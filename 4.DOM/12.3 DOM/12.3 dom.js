// Fig. 12.5: dom.js 
// Script to demonstrate basic DOM functionality. 

var currentNode;
var idcount=0;

function start(){
    document.getElementById( "byIdButton" )
        .addEventListener("click", byId, false );
     document.getElementById( "insertButton" )
        .addEventListener("click", insert, false );
     document.getElementById( "appendButton" )
        .addEventListener("click", appendNode, false );
     document.getElementById( "replaceButton" )
        .addEventListener("click", replaceCurrent, false );
     document.getElementById( "removeButton" )
        .addEventListener("click", remove, false );
     document.getElementById( "parentButton" )
        .addEventListener("click", parent, false );

    // initialize currentNode
    currentNode = document.getElementById( "bigheading" );
}

window.addEventListener("load", start, false);

// insert a paragraph element before the current element
// using the insertBefore method
function byId(){
    var id = document.getElementById("gbi").value;
    var target = document.getElementById(id);

    if(target)
        switchTo(target);
}

// append a paragraph node as the child of the current node
function insert(){
    var newNode = createNewNode(document.getElementById("ins").value);
    currentNode.parentNode.insertBefore( newNode, currentNode );
    switchTo( newNode );
}

// append a paragraph node as the child of the current node
function appendNode(){
    var newNode = createNewNode(document.getElementById("append").value);
    currentNode.appendChild(newNode);
    switchTo(newNode);
}

// replace the currently selected node with a paragraph node
function replaceCurrent(){
    var newNode = createNewNode(document.getElementById("replace").value);
    currentNode.parentNode.replaceChild(newNode, currentNode);
    switchTo(newNode);
}

// remove the current node
function remove(){
    if(currentNode.parentNode == document.body){
        alert("Can't remove a top-level element.");
    }
    else{
        var oldNode = currentNode;
        switchTo(oldNode.parentNode);
        currentNode.removeChild(oldNode);
    }
}

// get and highlight the parent of the current node
function parent(){
    var target = currentNode.parentNode;

    if(target != document.body) 
        switchTo(target);
    else 
        alert("No Parent");
}

// helper function that returns a new paragraph node containing
// a unique id and the given text
function createNewNode(text){
    var newNode = document.createElement("p");
    nodeId = "new" + idcount;
    ++idcount;

    newNode.setAttribute("id", nodeId);
    text = "[" + nodeId + "]" + text;
    newNode.appendChild(document.createTextNode(text));
    return newNode;
}

// helper function that switches to a new currentNode
function switchTo(newNode){
    currentNode.setAttribute("class", "");
    currentNode = newNode;
    
    currentNode.setAttribute("class", "highlighted");
    document.getElementById("gbi").value = currentNode.getAttribute("id");
}
