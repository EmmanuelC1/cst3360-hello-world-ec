<?php
    
    function getDatabaseConnection() {
        $host = "localhost";
        $username = "emmanuelc";
        $password = "Anewhope2"; // best practice: define this in a separte file
        $dbname = "midterm"; 
        
        // Create connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        return $dbConn; 
    }
    
    function displayQuote() {
        $dbConn = getDatabaseConnection(); 
        
        $sql = "SELECT * from q_quotes ORDER BY RAND() LIMIT 1";  
        
        // echo "POST: "; 
        // print_r($_POST);
        // echo "<br/>"; 
        
        
        // $link = mysql_connect("localhost", "emmanuelc", "Anewhope2");
        // mysql_select_db("midterm", $link);
        // $result = mysql_query("SELECT * FROM q_quotes", $link);
        // $num_rows = mysql_num_rows($result);
        
        // echo "$num_rows Rows\n";
        
       // $randomlySelected = rand(1, $num_rows);
          
        $statement = $dbConn->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        foreach ($records as $record) {

          echo  '<div class="quoteDiv">'; 
          echo  '<h2 class="quote">' . $record["quote"] . '</h2>'; 
          echo  '<h2 class="author">'. '-'. $record["author"] . '</h2>'; 
          echo  '</div>';
          
        }
    }    

?>

<!DOCTYPE>
<html>
    <head>
        <title>Quotes</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php displayQuote(); ?>
        
        <a href="create.php">Create</a>
    </body>
    
</html>