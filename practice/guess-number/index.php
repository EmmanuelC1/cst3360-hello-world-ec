<?php

//PLAN:
//1. Generate a random number ==> store it in the session [DONE]
//2. Hahve a form where user can enter their guesses
//3. Form validation logic ==> determine whether the guess is too high/low
//4. Store the history in the session
//5. Clear the session when the user clicks "Start Over" [DONE]

session_start();

if(isset($_POST['destroy']))
{
    session_destroy();
    session_start();
}

if(!isset($_SESSION['randomVal'])) 
{
    $_SESSION['randomVal'] = rand(1, 100);
    $_SESSION['$prevGuesses[]'] = array();
    
}

//print_r($_POST)

?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        Guess the number (between 1 and 100) <br> </br>
        Your Guess: <textarea id="guess" cols="15" rows="1"></textarea> 
        <input type="submit"value="submit">
        <br>
        <?php
            
        ?>
        
        Random Number: <?php echo ($_SESSION['randomVal']) ?>
        
        <form method="POST">
            <br>
            <input type="submit" name="destroy" value="Start Over">
        <form/>
    </body>
</html>