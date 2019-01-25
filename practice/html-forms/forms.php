<?php
session_start();
$_SESSION["babyNames[]"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Baby Names</title>
    </head>
    <body>
        <form action="forms.php" method="POST">
            Baby Names:    <br>
            <input type="radio"  id="item1"  name="babyNames[]" value="1">
                 <textarea id="feedback" cols="30" rows="1"></textarea> <br>
            <input type="radio"  id="item2"  name="babyNames[]" value="2">
                  <textarea id="feedback" cols="30" rows="1"></textarea> <br>
            <input type="radio"  id="item3"  name="babyNames[]" value="3">
                 <textarea id="feedback" cols="30" rows="1"></textarea> <br>
            <input type="radio"  id="item4"  name="babyNames[]" value="4">
                  <textarea id="feedback" cols="30" rows="1"></textarea> <br>
            <input type="radio"  id="item5"  name="babyNames[]" value="5">
                  <textarea id="feedback" cols="30" rows="1"></textarea> <br> <br>
            <input type="submit" value="Save"/>
            <input type="submit" value="Clear"/>
            
  </form>
          <br>
          <div>Favorite Name is: </div>
    </body>
</html>


<?php
echo '<p>$_POST: ';
echo '<pre>';
var_dump($_POST);
echo '</pre>';
echo "</p>";

?>