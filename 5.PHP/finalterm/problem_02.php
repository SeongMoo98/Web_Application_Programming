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
        switch ($post_data->sort_base){
            case "title":
                $select_sql = "SELECT * FROM mylink ORDER BY title " . $post_data->sort_type;
                break;
            case "count":
                $select_sql = "SELECT * FROM mylink ORDER BY count " . $post_data->sort_type;
                break;            
            default:
                $select_sql = "SELECT * FROM mylink ORDER BY classify " . $post_data->sort_type;
        }
        
        $data_arr = array();

        if ( $result = $mysqli->query($select_sql) ) {
            while($data = $result->fetch_assoc()){
                array_push($data_arr, array("error"=>"no", 
                                            "classify"=>$data['classify'],
                                            "title"=>$data['title'],
                                            "link"=>$data['link'], 
                                            "count"=>$data['count'], 
                                            "icon"=>$data['icon']));
            }
            $result->close();
        }
        else {
            $data_arr = array('error' => 'yes');
        }
        echo(json_encode($data_arr));
    }
    else if ($post_data->mode == "search"){
        $sql = "SELECT * FROM mylink WHERE title='".$post_data->title."'";
        $data_arr = array();
        if ( $result = $mysqli->query($sql) ) {
            while($data = $result->fetch_assoc()){
                $data['count'] += 1;
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
        $classify = $post_data->classify; 
        $title = $post_data->title;
        $link = $post_data->link; 
        $icon = $post_data->icon;
        
        $sql = "SELECT * FROM mylink WHERE title='".$post_data->title."'";
        if ( $result = $mysqli->query($sql) ) {
            if ($result->num_rows > 0){
                echo (json_encode(array("error"=>"yes")));
            }
            else{
                $sql = "INSERT INTO mylink ('classify', 'title', 'icon','link')"
                    +"VALUES ('" . $classify . "', " . "'" . $title . "', " . "'" . $icon . "', " . "'" . $link . "')"; 
                // $sql = "insert into mylink set classify = '".$classify."', title = '".$title."',
                // icon = '".$icon."', link = '".$link."'";
                /**/
                $result = $mysqli->query($sql);
                echo (var_dump($result));
                /**/  
                echo(json_encode(array("error"=>"no")));
            }
            $result->close();
        }
    }
    else if($post_data->mode =="delete"){
        $sql = "DELETE FROM mylink WHERE 'title' = '" . $post_data->title . "'";
        if( !($result = $mysqli->query($sql)) ){
            echo (json_encode(array("error" => "yes")));
        }
    }
    else if ($post_data->mode == "start"){
        $select_sql = "select * from mylink order by title asc";
        if ( $result = $mysqli->query($select_sql) ) {
            $totalCount = $result->num_rows;
        }
        echo (json_encode(array("total"=>$totalCount))); 
    }

    $mysqli->close();
?>