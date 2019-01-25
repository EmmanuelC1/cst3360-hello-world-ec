<?php

include 'inc/charts.php';
$posters = array("ready_player_one","rampage","paddington_2","hereditary","alpha","black_panther","christopher_robin","coco","dunkirk","first_man");
function movieReviews() {
    global $posters;
    
    for($i=0; $i<4; $i++)
    {
        $posterArray = array();
        $randomPoster = $posters[rand(0,count($posters)-1)];
        array_push($posterArray, $randomPoster);
    }
       sort($posterArray);  
    
    echo "<div class='poster'>";
    echo "<h2> $randomPoster </h2>";
    echo "<img width='100' src='img/posters/$randomPoster.jpg'>";    
    echo "<br>";
    
    //NOTE: $totalReviews must be a random number between 100 and 300
    $totalReviews = rand(100,300); 
    
    //NOTE: $ratings is an array of 1-star, 2-star, 3-star, and 4-star rating percentages
    //      The sum of rating percentages MUST be 100
    $reviewCounter = 0;
    for($i=0; $i<4; $i++)
    {
    $reviewCounter = rand(0,(100-$reviewCounter));
    $ratings = array();
    $ratings = array_push($ratings, $reviewCounter);
    }
    
    //NOTE: displayRatings() displays the ratings bar chart and
    //      returns the overall average rating
    $overallRating = displayRatings($totalReviews,$ratings);
    
    //NOTE: The number of stars should be the rounded value of $overallRating
    echo "<br><img src='img/star.png' width='25'>";
    echo "<img src='img/star.png' width='25'>";
    
    echo "<br>Total reviews: $totalReviews";
    echo "</div>";
}    

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Movie Reviews </title>
        <style type="text/css">
            body {
                text-align:center;
            }
            #main {
                display:flex;
                justify-content: center;
            }
            .poster {
                padding: 0 10px;
            }
        </style>
    </head>
    <body>
       
       <h1> Movie Reviews </h1>
        <div id="main">
           <?php
             //NOTE: Add for loop to display 4 movie reviews
             for($k=0; $k<4; $k++)
             {
                  movieReviews();
             }
           ?>
       </div>
       <br/>
       <hr>
       <h1>Based on ratings you should watch:</h1>
       
    </body>
</html>