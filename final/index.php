<?php
session_start();
function getDatabaseConnection() {
        if (strpos($_SERVER['SERVER_NAME'], "c9users") !== false) {
        // running on cloud9
        $host = "localhost";
        $username = "emmanuelc";
        $password = "Anewhope2"; // best practice: define this in a separte file
        $dbname = "final"; 
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
    
    function getData() {
        $dbConn = getDatabaseConnection(); 
        
        $sql = "SELECT * from race_details";  
        
        $statement = $dbConn->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        foreach ($records as $record) {

          echo  '<tr>';
          echo '<td>'. $record["race_id"] . '</td>'; 
          echo '<td>'. $record["race_date"] . '</td>'; 
          echo '<td>'. $record["start_time"] . '</td>'; 
          echo '<td>'. $record["location"] . '</td>'; 
          echo '<td><img src="img/racing-actions-edit.png" style="width:25px"></td>';
          echo '<td><img src="img/racing-actions-cancel.png" style="width:25px"></td>';
          echo '<td><img src="img/racing-actions-racers.png" style="width:25px"></td>';
          echo '</tr>';
          
        }
    }  
    
    
    function addRacer()
    {
        session_destroy();
        if(isset($_POST['Save'])) 
        {
            
            $raceID = $_POST['raceID'];
            $codeName = $_POST['codeName'];
            $year = $_POST['year'];
            $make = $_POST['make'];
            $model = $_POST['model'];
            $comments = $_POST['comments'];
                    
        $dbConn = getDatabaseConnection(); 
        
        $sql = "INSERT INTO `racer_info` (`race_id`, `code_name`, `year`, `make`, `model`, `comments`) VALUES ('$raceID', '$codeName', '$year', '$make', '$model', '$comments')";  
        
        $statement = $dbConn->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Racing Final </title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div id="header">
            <h1>Races</h1>
        </div>
        
        <div id="table">
        <table align="center">
            <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>Location</th>
                <th align="right">Past races</th>
                <th>
                <button class="add action">
                        <img src="img/racing-add.png" style="width: 20px" />
                    </button>
                </th>    
            </thead>
            <tbody>
                <!--Put all the pages data here-->
                <?php getData(); ?>
                
            </tbody>
        </table>
        
        <div id="modalBox" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Add Racer</h1>
            
            <div>
                <label for="raceID">Race ID</label>
                <input id="raceID" type="text">
            </div>
            
            <div>
                <label for="codeName">Code Name</label>
                <input id="codeName" type="text">
            </div>
            
            <div>
                <label for="year">Year</label>
                 <input id="year" type="text">
            </div>
            
            <div>
                <label for="make">Make of Car</label>
                <input id="make" type="text">
            </div>
            
            <div>
                <label for="model">Model</label>
                <input id="model" type="text">
            </div>
            
            <div>
                <label for="comments">Comments</label>
                <textarea id="comments" rows="5"></textarea>
            </div>
            
            <div>
                <input type="submit" value="Add Racer" name="Save"/>
                <?php addRacer(); ?>
            </div>

    </div>
    
    <a href="rubric.html">Link to Rubric</a>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="racing.js"></script>
    </body>
</html>