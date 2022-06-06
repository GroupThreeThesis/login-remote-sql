<?php
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, ");
    //Dev
    //$connect = mysqli_connect("localhost", "root", "", "Web_Database");

    //Remote
    $connect = mysqli_connect("sql3.freesqldatabase.com", "sql3497946", "muEgTUewMn", "sql3497946");

    $token = null;
    $headers = apache_request_headers();

    $postdata = file_get_contents("php://input");

   


    if (isset($postdata) && !empty($postdata)){
        $request = json_decode($postdata);

        $username = $request -> username;
        $password = $request -> password;
        $encryptPassword = MD5($password); 

        $query = "SELECT Username, Password FROM Admin";
        $result = mysqli_query($connect, $query);
        $fetch = mysqli_fetch_assoc($result);

        $fUsername = $fetch["Username"];
        $fPassword = $fetch["Password"];
  

       if ($username == $fUsername &&  $encryptPassword == $fPassword){
            echo json_encode(
                    array(
                        "message" => "Successful Login",
                        "token" =>  "Bearer-123",
                        "email" =>   $username
                    ));
                   // http_encode_response(200);
          }
          else{
          //  http_encode_response(401);
            echo json_encode(array( "message" => "Login Failed"));
            
          
    }
}
?>