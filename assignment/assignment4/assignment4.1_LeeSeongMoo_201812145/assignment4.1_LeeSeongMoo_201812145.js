function makeLogo() {
    var title = document.forms[0].title.value;
    var description = document.forms[0].description.value;
    var publish = document.forms[0].publish.value;
    var author = document.forms[0].author.value;

    if (title == "" || description == "" || publish == "" || author == ""){
        window.alert("입력이 누락되었습니다.");
    }
    else {
        document.getElementById("cover_title").innerHTML = title;
        document.getElementById("cover_description").innerHTML = description;
        document.getElementById("cover_publish").innerHTML = "(주)" + publish;
        document.getElementById("cover_author").innerHTML = author + " 지음";
        document.getElementById("cover").style.visibility = "visible";
    }
}

function clearAll() {
    document.getElementById("cover").style.visibility = "hidden";
}