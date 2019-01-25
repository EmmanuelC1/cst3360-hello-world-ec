<?php

session_start();
$_SESSION["count"] = $_SESSION["count"]+1;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sessions</title>
    </head>
    <body>
        
        <div>
            Count: <?php echo $_SESSION["count"]; ?>
        </div>
        
    </body>
</html>