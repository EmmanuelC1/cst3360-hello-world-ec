<?php
    session_start();
    
    function order()
    {
        session_destroy();
        if(isset($_POST['Save'])) 
        {
            
            $name = $_POST['name'];
            $patties = $_POST['patties'];
            $tomato = $_POST['tomato'];
            $cheese = $_POST['cheese'];
            $onion = $_POST['onion'];
            $selection = $_POST['selection'];
            
            $order = array();
            
            if(isset($_POST['name']))
            {
                echo "Order for " . "$name" . ": ";
                echo "<br> <br>";
            }
            else
            {
                echo "Please enter your name!";
                echo "<br>";
            }
            
            if($selection == small)
            {
                echo "A Small ";
            }
            else if($selection == medium)
            {
                echo "A Medium ";
            }
            else if($selection == large)
            {
                echo "A Large ";
            }
            else 
            {
                 echo "Please enter the size of the meal!";
                 echo "<br>";
            }
            
            
            if($patties == 1)
            {
                echo "Classic Burger with one patty";
                echo "<br>";
            }
            else if($patties == 2)
            {
                echo "Classic Burger with two patties";
                echo "<br>";
            }
            else if($patties == 3)
            {
                echo "Classic Burger with three patties";
                echo "<br>";
            }
            else
            {
                echo "No selection for number of patties!";
                echo "<br>";
            }
            
            echo "<br> Ingredients Include: <br>";
            
            if(isset($_POST['tomato']))
            {
                echo "Tomatoes <br>";
            }
            if(isset($_POST['cheese']))
            {
                echo "Cheese <br>";
            }
            if(isset($_POST['onion']))
            {
                echo "Onions <br>";
            }
            if(!isset($_POST['tomato']) && !isset($_POST['cheese']) && !isset($_POST['onion']))
            {
                echo "Please add at least one ingredient to your order <br>";
            }
            
            
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Castillo's Burger Shop</title>
    </head>
    <link href="styles.css" rel="stylesheet" type="text/css">
    
    <body>
        <div class="container">
            <h1> Castillo's Burger Shop</h1>
            <form method="POST">
                <h2>Name on the Order:</h2>
                
                <input type="text" id="textstyle" size="12" name="name" value=" <?php echo isset($_POST['name']) ? $_POST['name']: '' ?>" />
                <br>
                
                <h3>Number Of Patties</h3>
                <input type="radio" name="patties" id="buttons" value="1" <?php if(isset($_POST['patties']) && $_POST['patties'] == 1) echo ' checked= "checked"'; ?> />
                <label for="buttons">One Patty</label>
                <input type="radio" name="patties" id="buttons" value="2" <?php if(isset($_POST['patties']) && $_POST['patties'] == 2) echo ' checked= "checked"'; ?> />
                <label for="buttons">Two Patties</label>
                <input type="radio" name="patties" id="buttons" value="3" <?php if(isset($_POST['patties']) && $_POST['patties'] == 3) echo ' checked= "checked"'; ?> />
                <label for="buttons">Three Patties</label>
                <br>
                
                <h4>Choose Your Ingredients:</h4>
                <input type="checkbox" name="tomato" value="Tomatoes" <?php if(isset($_POST['tomato']) && $_POST['tomato'] == 'Tomatoes') echo ' checked= "checked"'; ?> />
                Tomatoes <br>
                <input type="checkbox" name="cheese" value="Cheese" <?php if(isset($_POST['cheese']) && $_POST['cheese'] == 'Cheese') echo ' checked= "checked"'; ?> />
                Cheese <br>
                <input type="checkbox" name="onion" value="Onions" <?php if(isset($_POST['onion']) && $_POST['onion'] == 'Onions') echo ' checked= "checked"'; ?> />
                Onions <br>
                
                <h5>What Size?</h5>
                <select name="selection">
                    
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                    
                </select>
                
                <br> </br>
                <input type="submit" value="Complete Order" name="Save"/>
                <br>
            </form>
        </div>
        
        <div class="order">
            <?php
              order();  
            ?>    
        </div>
    </body>
</html>