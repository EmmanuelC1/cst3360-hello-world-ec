<?php

session_start();

$httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);

switch($httpMethod) {
  case "OPTIONS":
    // Allows anyone to hit your API, not just this c9 domain
    header("Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Access-Control-Max-Age: 3600");
    exit();
  case "POST":
    // Get the body json that was sent
    $rawJsonString = file_get_contents("php://input");

    // Make it a associative array (true, second param)
    $postedJsonData = json_decode($rawJsonString, true);

    // Lookup the user in the user table
    $servername = getenv('IP');
    $dbPort = 3306;
    
    // Which database (the name of the database in phpMyAdmin)?
    $database = "roundtrip";
    
    // My user information...I could have prompted for password, as well, or stored in the
    // environment, or, or, or (all in the name of better security)
    $username = getenv('C9_USER');
    $password = "";
    
    // Establish the connection and then alter how we are tracking errors (look those keywords up)
    $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    ////////////////////////////////////////////////////////////////////////////////
    // This is an example of a "select where" 
    ////////////////////////////////////////////////////////////////////////////////
    
    $whereSql = "SELECT * FROM user WHERE username = :userName"; 
    
    // The prepare caches the SQL statement for N number of parameters imploded above
    $whereStmt = $dbConn->prepare($whereSql);
    
    // Just have to pop in the associative array that comes from json_decode
    $whereStmt->execute($postedJsonData);
    
    $userJsonData = $whereStmt->fetchAll(PDO::FETCH_ASSOC);
    
    $results = ["found" => boolval(count($userJsonData)),
                "data" => $userJsonData];

    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    // Let the client know the format of the data being returned
    header("Content-Type: application/json");

    // Sending back down as JSON
    echo json_encode($results);
    
    break;
  case 'GET':
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    
    http_response_code(401);
    echo "Not Supported";
    
    break;
    
  case 'PUT':
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    
    http_response_code(401);
    echo "Not Supported";
    break;
  case 'DELETE':
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    
    http_response_code(401);
    break;
}
?>
