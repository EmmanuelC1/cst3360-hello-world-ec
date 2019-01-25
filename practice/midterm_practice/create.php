<?php
//include 'cst336_midterm.php';

function createQuote($quote, $author) {
    
    
    $quote = $_POST['quote'];
    $author = $_POST['author'];
    
    if(isset($_POST['Sumbit'])) {
        
    
    // if(isset($_POST['quote']))
    //         {
    //             $sql = "INSERT INTO q_quotes (quote, author) VALUES ('$quote', '$author')";
    //         }
    //         else if(!isset($_POST['quote'] && isset($_POST['author'])))
    //         {
    //             echo "Please enter something in quote box!";
    //             echo "<br>";
    //         }
    //         else if(isset($_POST['quote'] && !isset($_POST['author'])))
    //         {
    //              echo "Please enter something in author box!";
    //             echo "<br>";
    //         }
    //         else
    //         {
    //             echo "Please enter something in BOTH boxes!";
    //             echo "<br>";
    //         }
    
   
    
    // construct the proper SQL INSERT statement
    $dbConn = getDatabaseConnection(); 

    $sql = "INSERT INTO `q_quotes` (`quoteId`, `quote`, `author`) VALUES (NULL, '$quote', '$auhtor', NOW());"; 
    
    $statement = $dbConn->prepare($sql); 
    $result = $statement->execute(); 
    
    if (!$result) {
      return null; 
    }
    
    $last_id = $dbConn->lastInsertId();

    
    // fetch the newly created object from database
    
    $sql = "SELECT * from all_memes WHERE id = $last_id"; 
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    $newQuote = $records[0]; 
    
    return $newQuote; 
}
}
?>

<html>
    <head>
        <title>Create Quote</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <h3> Create New Quote: </h3> <br>
        <div class="form">
        <form method="post" action="cst336_midterm.php">
             Quote: <input type="text" name="quote"></input> <br/>
             Author: <input type="text" name="author"></input> <br/>
             
             <input type="submit"></input>
        </form>
        <?php createQuote($_POST['quote'], $_POST['author']) ?>
        </div>
        
    </body>
</html>