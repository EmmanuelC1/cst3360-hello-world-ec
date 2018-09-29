
<!DOCTYPE html>
<html>
    <head>
        <title> NBA Finals Predictions </title>
        <style>
            @import url("styles.css");
        </style>
    </head>
    <body>
        <h1>NBA Finals Predictions</h1>
        <h2>Best of Seven Series</h2>
        <div id="main">
            <?php
               play(); 
            ?>
            
            <form>
                <input type="submit" value="Generate"/>
            </form>
        </div>
    </body>
</html>


<?php
    function displayLogoWest($randomValue1, $pos1) {
            
            switch($randomValue1) {
              case 0: $logo1 = "warriors";
                    break;
              case 1: $logo1 = "rockets";
                    break;
              case 2: $logo1 = "lakers";
                    break;

          }
          echo "<img id='west' src='img/west/$logo1.png' alt='$logo1' title='".ucfirst($logo1)."' width='350' >";
          
       }
        function displayLogoEast($randomValue2, $pos2) {
            switch($randomValue2) {
                case 0: $logo2 = "76ers";
                        break;
                case 1: $logo2 = "celtics";
                        break;
                case 2: $logo2 = "raptors";
                        break;
            }
            echo "<img id='east' src='img/east/$logo2.png' alt='$logo2' title='".ucfirst($logo2)."' width='350' >";
            
            echo "<div id='output'>";
            $westWins = rand(0,4);
            echo "<div class='winsWest'>$westWins</div>";
                if($westWins == 4)
                {
                    $eastWins = rand(0,3);
                     echo "<div class='winsEast'>$eastWins</div>";
                }
                else if($westWins != 4)
                {
                    $eastWins = 4;
                    echo "<div class='winsEast'>$eastWins</div>";
                }
                else
                {
                    $eastWins = rand(0,4);
                     echo "<div class='winsEast'>$eastWins</div>";
                }
                if($westWins > $eastWins)
                {
                    echo "<h3> $logo Win!</h3>";
                }
                else
                {
                    echo "<h4> $logo2 Win! </h4>";
                } 
            echo "</div>";
        }
            
    function play() {
            
            for ($i=0; $i<1; $i++) {
                ${"randomValue" . $i } = rand(0,2);
                ${"randomValue2" . $i } = rand(0,2);
                displayLogoWest(${"randomValue" . $i}, $i);
                displayLogoEast(${"randomValue2" . $i}, $i);
            }
        }    
?>