<?php
// connect to our mysql database server
function getDatabaseConnection() {
    if (strpos($_SERVER['SERVER_NAME'], "c9users") !== false) {
        // running on cloud9
        $host = "localhost";
        $username = "emmanuelc";
        $password = "Anewhope2"; // best practice: define this in a separte file
        $dbname = "memes_v2"; 
    } else {
        // running on Heroku
        $host = "us-cdbr-iron-east-01.cleardb.net";
        $username = "b4f420ebda5a76";
        $password = "95130a53"; 
        $dbname = "heroku_8eed5fa5ba5c668"; 
    }
    
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConn; 
}
// temporary test code
//$dbConn = getDatabaseConnection(); 
?>