<?php
    $input = json_decode(file_get_contents("../json/create-blog-request.json"), true);
    var_dump($input);
    try{
        /*session_start();
        if(isset($_SESSION["signedInUserid"])){
            throw new Exception("Inte inloggad");
        }
        if($input["uid"] != $_SESSION["signedInUserid"]){
            throw new Exception("Inte inloggad");
        }*/

    include "../database/database.php";
    $connection = new DBconnection();

    $blogid = $input["bid"];
    $userid = $input["uid"];
    $title = $input["title"];
    $date = $input["date"];
    $text = $input["text"];

    $sql = "SELECT uid FROM participation WHERE uid = $uid AND bid = $bloggid";
    $result = $connection->query($sql);
    if($result->num_rows == 1){
        $sql = "INSERT INTO post(title, date, text, bid) VALUES (?,?,?,?)"; 
        if(connection->insert($sql, [$title] [$date] [$text] [$blogid]) === false){
            throw new Exception("Kunde inte lägga till post");    
        }
    }

    $response = [
        "status"=>true,
        "message"=>"Post tillagd"
    ];

    }catch(Exception $exc){
        $response = [
            "status"=>false,
            "message"=>$exc->getMessage()
        ];
    }
    echo json_encode($response);
?>