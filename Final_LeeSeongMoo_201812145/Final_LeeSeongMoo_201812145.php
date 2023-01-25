<?php
    ini_set('display_errors', 1);   // 에러 메시지 출력 On
    header('Content-type: application/json');
    header("Access-Control-Allow-Origin: *");
    $totalCount = 0;
    // Connect to MySQL
    $mysqli = new mysqli("localhost:3307", "root", "tjdan34", "201812145");

    if ( $mysqli->connect_errno )
        die( "<p>Could not connect to database</p>" );

    $post_data = json_decode(file_get_contents('php://input'));

    if ($post_data->mode == "show"){
        $select_sql = "SELECT * FROM infos";
        
        $data_arr = array();

        if ( $result = $mysqli->query($select_sql) ) {
            while($data = $result->fetch_assoc()){
                array_push($data_arr, array("error"=>"no", 
                "group"=>$data['group'],
                "name"=>$data['name'], 
                "tel"=>$data['tel'], 
                "birth"=>$data['birth'],
                "email"=>$data['email'],
                "memo"=>$data['memo']));
            }
            $result->close();
        }
        else {
            $data_arr = array('error' => 'yes');
        }
        echo(json_encode($data_arr));
    }
    else if ($post_data->mode == "search"){
        $sql = "SELECT * FROM infos WHERE name='".$post_data->name."'";
        $data_arr = array();
        if ( $result = $mysqli->query($sql) ) {
            while($data = $result->fetch_assoc()){
                array_push($data_arr, array("error"=>"no"));
            }
            $result->close();
        }
        else {
            $data_arr = array('error' => 'yes');
        }
        echo(json_encode($data_arr));
    }
    else if ($post_data->mode == "insert"){
        $group = $post_data->group;
        $name = $post_data->name;
        $tel = $post_data->tel;
        $birth = $post_data->birth;
        $email = $post_data->email;
        $memo = $post_data->memo;

        if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}/", $birth)){
            throw new Exception("Invalid Birth Day");
        }
        $mysqli->query("INSERT INTO infos ('group', 'name', 'tel', 'email', 'memo') VALUES ('$group', '$name', '$tel', '$email','$memo')");
        echo(json_encode(array("error"=>"no")));
    }
    else if ($post_data->mode == "start"){
        $mysqli->query("SELECT * FROM infos ORDER BY 'name' ASC");
        echo (json_encode(array("error" => "no")));
    }

    $mysqli->close();
?>