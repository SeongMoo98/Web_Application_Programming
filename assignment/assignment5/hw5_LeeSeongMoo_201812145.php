<!-- 파일이름을 바꿔 form의 action도 수정하였습니다. -->
<?php
    ini_set('display_errors', 1);   // error message On

    // Initialize variables
    $mode = "select";
    $totalCount = 0;
    $curPage = 0;
    $err = "";

    // Connect to MySQL
    $link = mysqli_connect("localhost", "root", "tjdan34");
   
    if( !($database = $link) ){
        die("<p>Could not connect to database</p>");
    }
    
    // Check and assignment POST parameters
    // addContact(), delContact(), clearAll()에서
    // hidden으로 'mode'를 설정  
    if(isset($_POST['mode']))
        $mode = $_POST['mode'];

    if(isset($_POST['curPage']))
        $curPage = $_POST['curPage'];

    $query = "";

    if(!mysqli_select_db($database, "201812145")){
        die("<p>Could not open database</p>");
    }

    // Sql query processing according to mode
    if ($mode == "insert"){   
        //중복 체크
        $query = "SELECT * FROM contacts WHERE name='". $_POST['txt_name'] ."'";
        
        if($result = mysqli_query($database, $query)){
            if( mysqli_num_rows($result) > 0 ){
                $err = "이미 있는 연락처입니다. 다시 입력해주세요.";
            }
            else{
                $query = "INSERT INTO contacts".
                    "(name, tel, email, memo) ".
                    "VALUES ('".$_POST['txt_name']."', ".
                    "'".mysqli_real_escape_string($link,$_POST['txt_tel'])."', ".
                    "'".$_POST['txt_email']."', ".
                    "'".$_POST['txt_memo']."' )"; 
    
                mysqli_query($database, $query);
            }
        }
    }
    else if ($mode == "delete"){
        //존재 여부 체크
        $txt_name = $_POST['txt_name'];
        
        $query = "SELECT * FROM contacts WHERE name='$txt_name'";
        if($result = mysqli_query($database, $query)){
            if( mysqli_num_rows($result) ==  0 ){
                $err = "존재하지 않는 연락처입니다. 다시 입력해주세요.";
            }
            else{
                $query = "DELETE FROM contacts WHERE name='$txt_name' ";
                mysqli_query($database, $query);
            }
        }
    }
    else if ($mode == "delete_all"){
        $query = "DELETE FROM contacts";
        mysqli_query($database, $query);
    }
    
    // Execute select query
    $select_sql = "SELECT * FROM contacts ORDER BY name ASC";
    $data_arr = array();

    if($result = mysqli_query($database, $select_sql)){
        $totalCount = mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
            $data_arr[] = $row;
        }
        
    }
        

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Example</title>
    <style type="text/css">
        #maindiv {
            width: 300px;
            float: left;
        }
        label {
            display: inline-block;
            width: 85px;
        }
        #div_btn {
            margin: 5px 0px;
        }
        #contactContainer {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            width: 200px;
            height: 250px;
        }    
        #contactContainer .contactBox {
            text-align: center;
            font-size: 1.5em;
            border: 1px solid;
            width: 80px;
            margin: 1px;
            padding: 5px;
            cursor: pointer;
        }
        #div_fullInfo {
            visibility: hidden;
            float: left;
            width: 200px;
            border: 2px solid black;
            border-radius: 10px;
            text-align: center;
        }
        #div_fullInfo span {
            display: block;
            font-size: 1.2em;
        }
        .pagination {
            visibility: hidden;
            display: inline-block;
        }
        .pagination div {
            float: left;
            padding: 8px 16px;
        }
        .pagination div.active {
            background-color: #4CAF50;
            color: white;
        }
        .pagination div:hover:not(.active) {background-color: #ddd;}
    </style>
    <script type="text/javascript">
        // php 배열을 javascript 배열에 바로 대입하고 싶을때는 json을 활용
        var contactArr = <?php echo json_encode($data_arr);?>;    
        var curPage = 0;

        // php에서 생성한 에러 메시지를 경고창으로 띄워주는 함수
        function makeAlert()    
        {
            var err = "<?php echo $err;?>";
            if (err.length > 0)
            {
                window.alert(err);
                return;
            }
        }        
        function addContact()
        {
            var name = document.getElementById("txt_name").value;
            var tel = document.getElementById("txt_tel").value;
            var email = document.getElementById("txt_email").value;
            var memo = document.getElementById("txt_memo").value;

            if (name == "" || tel == "")
            {
                window.alert("이름과 연락처는 꼭 입력해야 합니다.");
                return;
            }
            document.getElementById("mode").value = "insert";
            document.forms[0].submit();
        }
        function findContact(name)
        {
            for (var contactIdx in contactArr)
            {
                if (contactArr[contactIdx].name == name)
                    return contactIdx;
            }
            return -1;
        }

        function delContact()
        {
            if (document.getElementById("txt_name").value == "")
            {
                window.alert("제거할 연락처의 이름을 입력해주세요.");
                return;
            }
            document.getElementById("mode").value = "delete";
            document.forms[0].submit();
        }
        function clearAll()
        {
            document.getElementById("mode").value = "delete_all";
            document.forms[0].submit();
        }
        function showContacts()
        {
            var contactContainer = document.getElementById("contactContainer");
            contactContainer.innerHTML = "";

            var startIdx = curPage * 10;
            var endIdx = startIdx + 9;
            for(var idx = startIdx; idx <= endIdx && idx < contactArr.length; idx++)
            {
                var contact = makeContact(contactArr[idx].name);
                contactContainer.innerHTML += contact;
            }
            document.getElementById("div_fullInfo").style.visibility = "hidden";
        }
        function showContactInfo(name)
        {
            var contact = contactArr[findContact(name)];
            document.getElementById("info_name").innerHTML = contact.name;
            document.getElementById("info_tel").innerHTML = contact.tel;
            if (contact.email.length > 0)
                document.getElementById("info_email").innerHTML = contact.email;
            else
                document.getElementById("info_email").innerHTML = "-";
            if (contact.memo.length > 0)
                document.getElementById("info_memo").innerHTML = contact.memo;
            else
                document.getElementById("info_memo").innerHTML = "-";
            document.getElementById("div_fullInfo").style.visibility = "visible";
        }
        function makeContact(name)
        {
            return "<div id='" + name + "' class='contactBox' onclick='showContactInfo(id)'>" + name + "</div>";
        }
        function makePages()
        {
            if (contactArr.length > 10)
            {
                var pageNav = document.getElementById("pageNav");
                pageNav.style.visibility = "visible";
                pageNav.innerHTML = "";
                var nPage = Math.ceil(contactArr.length / 10);
                for(var i =0; i < nPage; i++)
                {
                    if (i == curPage)
                        pageNav.innerHTML += "<div class=\"active\" onclick=\"changePage(" + i +")\">" + (i + 1) + "</div>";
                    else
                        pageNav.innerHTML += "<div onclick=\"changePage(" + i +")\">" + (i + 1) + "</div>";
                }
            }
            else
            {
                var pageNav = document.getElementById("pageNav");
                pageNav.style.visibility = "hidden";
                pageNav.innerHTML = "";
            }
        }
        function changePage(pageNum)
        {
            curPage = pageNum;
            makePages();
            showContacts();
        }

        function start()
        {
            makeAlert();
            makePages();
            showContacts();
        }
    </script>
    </head>
<body onload="start()">
    <div id="maindiv">
        <form name="form1" method="POST" action="hw5_LeeSeongMoo_201812145.php">
            <label for="txt_name">이름:</label><input type="text" name="txt_name" id="txt_name"><br>
            <label for="txt_tel">전화번호:</label><input type="text" name="txt_tel" id="txt_tel"></label><br>
            <label for="txt_email">이메일:</label><input type="text" name="txt_email" id="txt_email"></label><br>
            <label for="txt_memo">메모:</label><input type="text" name="txt_memo" id="txt_memo"></label><br>
            <div id="div_btn">
                <input type="button" name="addBtn" id="addBtn" value="연락처 추가" onclick="addContact()">
                <input type="button" name="delBtn" id="delBtn" value="연락처 삭제" onclick="delContact()">
                <input type="reset" name="ClearBtn" id="clearBtn" value="모두 삭제" onclick="clearAll()">
            </div>
            <!--submit 구분을 위한 hidden input 추가-->
            <input type="hidden" name="mode" id="mode" value="insert"/>
        </form>
        <br>
        <div id="contactContainer">
        </div>
        <nav class="pagination" id="pageNav">
        </nav>
    </div>
    <div id="div_fullInfo">
        <span id="info_name"></span>
        <span id="info_tel"></span>
        <span id="info_email"></span>
        <span id="info_memo"></span>
    </div>
</body>
</html>