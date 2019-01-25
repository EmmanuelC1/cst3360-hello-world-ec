<?php 
// include 'database.php';
// $dbConn = getDatabaseConnection();

// $username = POST['username'];

// function getUsername() {
//   global $dbConn;
  
//     $sql = "SELECT * FROM `users` WHERE username"; 
//     $statement = $dbConn->prepare($sql); 
//     $statement->execute();

//     $records = $statement->fetchAll(); 
// }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
  <body>
        <h1><img src="scoot.png" id="logo">
        
        <img src="avatar.png" class="profilePic" alt="Avatar" style="border-radius: 50%; width:10%">
        
        <h2>User's Name</h2>
        <h3>@username</h3>
        
        <div class="bio">
          <p>Lifelong writer. Gamer. Bacon lover. Devoted coffeeaholic. Professional alcohol practitioner. Food buff.</p>
        </div>
        
          <div align="center" class="postedImages">
            
            <img src="img/lime1.jpg" id="images" onclick="imagePopUp()">
            <img src="img/lime2.jpg" id="images">
            <img src="img/lime3.jpg" id="images">
            <br>
            <img src="img/lime4.jpg" id="images">
            <img src="img/lime5.jpg" id="images">
            <img src="img/lime6.jpg" id="images">
        </div>
       
  </body>
</html>