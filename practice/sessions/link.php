<?php
$currentCount = $_GET["count"];
$currentCount++;

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sessions</title>
    </head>
    <body>
        
        <div>
            Count: <?php echo $currentCount; ?>
        </div>
        
        <div>
            <a href="index.php?count=<?php echo $currentCount ?>">Click to Increment</a>
        </div>

    </body>
</html>