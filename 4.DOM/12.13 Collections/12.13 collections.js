// Fig. 12.14: collections.js 
// Script to demonstrate using the links collection.

function processLinks(){
    // get the document's links
    var linksLists = document.links;

    var contents = "<ul>";

    //concatenate each link to contents
    for( var i = 0; i < linksLists.length; i++){
        var currentLink = linksLists[i];
        contents += "<li><a href ='"+currentLink.href + "'>" +
            currentLink.innerHTML + "</li>";
    }

    contents += "<ul>";
    document.getElementById("links").innerHTML = contents;

}

window.addEventListener("load", processLinks, false);