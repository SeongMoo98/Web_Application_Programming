var info_arr = new Array();
var cur_page = 0;


function checkName(info){
    return info.name == document.forms[0].name.value;
}

function compareName(info1, info2){
    if(info1.name > info2.name)
        return 1;
    else if (info1.name < info2.name)
        return -1;
    else
        return 0;
}

function addTel(){
    var name_input = document.forms[0].name.value;
    var tel_input = document.forms[0].tel.value;
    var email_input = document.forms[0].email.value;
    var memo_input = document.forms[0].memo.value

    if(name_input == "" || tel_input == ""){
        window.alert("정보를 완전히 입력해주세요");
        return;
    }
    if(info_arr.findIndex(checkName) >= 0 ){
        window.alert("이미 있는 연락처입니다. 다시 입력해주세요.");
        return;
    }
    if (email_input == "") email_input = "-";
    if (memo_input == "") memo_input = "-";

    info_arr.push({name : name_input,  tel : tel_input, 
        email : email_input, memo : memo_input});                
    info_arr.sort(compareName);

    document.forms[0].reset();
    makePages();
    showNames();
    updateData();
}
    
function deleteTel(){
    var index = info_arr.findIndex(checkName)

    if(index < 0){
        window.alert("연락처가 없습니다.");
        return;
    }

    info_arr.splice(index, 1);
    makePages();
    showNames();
    updateData();
}

function clearAll(){
    info_arr = Array();
    document.getElementById("name_container").innerHTML = "";
    document.getElementById("page_nav").innerHTML = "";
    updateData();
}


function makePages(){
    var page_len = Math.ceil(info_arr.length / 10);
    var page_nav = document.getElementById("page_nav");
    if (info_arr.length >= 10) {
        page_nav.style.visibility = "visible";
        page_nav.innerHTML = "";

        for(var i =0; i < page_len; i++) {
            if (i == cur_page)
                page_nav.innerHTML += "<div class=\"active\" onclick=\"changePage(" + i +")\">" + (i + 1) + "</div>";
            else
                page_nav.innerHTML += "<div onclick=\"changePage(" + i +")\">" + (i + 1) + "</div>";
        }
    }
    else{
        page_nav.style.visibility = "visible";
        page_nav.innerHTML = "";
    }
}

function showNames(){
    var name_container = document.getElementById("name_container");
    name_container.innerHTML = "";

    var start = cur_page * 10;
    var end = start + 9;

    for(var i = start; i < info_arr.length && i <= end; i++){
        var name_box = makeNameBox(info_arr[i]);
        find_index = info_arr.findIndex(checkName);
        name_container.innerHTML += name_box;
    }
}

function makeNameBox(info){
    return "<p onclick = \"showInfo(this)\">" + info.name + "</p>";
}

function showInfo(paragraph){
    var info_box = document.getElementById("info_box");

    info_box.innerHTML = "";

    var info_name = paragraph.textContent;
    var index = -1;

    for(var i=0; i<info_arr.length; i++){
        if(info_name == info_arr[i].name){
            index = i;
            break; 
        }
    }

    info_box.innerHTML += "<p>"+info_arr[index].name+"</p>";
    info_box.innerHTML += "<p>"+info_arr[index].tel+"</p>";
    info_box.innerHTML += "<p>"+info_arr[index].email+"</p>";
    info_box.innerHTML += "<p>"+info_arr[index].memo+"</p>";

    info_box.style.visibility = "visible";

}
function changePage(page_num) {
    cur_page = page_num;
    makePages();
    showNames();
}

function updateData(){
    localStorage.removeItem("infos");
    localStorage.setItem("infos", JSON.stringify(info_arr));
}

function start(){
    var infos = localStorage.getItem("infos");
    if(infos != null){
        info_arr = JSON.parse(infos);
        makePages();
        showNames();
    }
}
window.start("load", start, false);


        
        