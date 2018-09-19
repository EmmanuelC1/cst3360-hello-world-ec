<!DOCTYPE html>
<html>

<head>
    <title> RPS </title>
    <style type="text/css">
        body {
            background-color: black;
            color: white;
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .col {
            text-align: center;
            margin: 0 70px;
        }

        .matchWinner {
            background-color: yellow;
            margin: 0 70px;
        }

        #finalWinner {
            margin: 0 auto;
            width: 500px;
            text-align: center;
        }
        
        hr {
            width:33%;
        }        
    </style>
</head>

<body>
    <?php 
        $randomValue1 = rand(0,2);
        displaySymbol($randomValue1);
        $randomValue2 = rand(0,2);
        displaySymbol($randomValue2);
        $randomValue3 = rand(0,2);
        displaySymbol($randomValue3);
        ?>
    
    <h1> Rock, Paper, Scissors </h1>

    <div class="row">
        <div class="col">
            <h2>Player 1</h2>
        </div>
        <div class="col">
            <h2>Player 2</h2>
        </div>
    </div>
    <?php
    function displaySymbol($randomValue)
    {
        if($randomValue==0) {
            echo '<img src-"img/rps-img/scissors.png" alt="scissors" title= Scissors" width="150" />';
        }
        else if($randomValue==1) {
            echo '<img src-"img/rps-img/rock.png" alt="rock" title= "Rock" width="150" />';
        }
        else {
            echo '<img src-"img/rps-img/paper.png" alt="paper" title= Paper" width="150" />';
        }
        ?>
    <!--<div class="row">-->
    <!--    <div class='col'><img src='img/rps-img/scissors.png' alt='scissors' width='150'></div>-->
    <!--    <div class='col, matchWinner'><img src='img/rps-img/rock.png' alt='rock' width='150'></div>-->
    <!--</div>-->
    <!--<hr>-->

    <!--<div class="row">-->
    <!--    <div class='col'><img src='img/rps-img/rock.png' alt='rock' width='150'></div>-->
    <!--    <div class='col, matchWinner'><img src='img/rps-img/paper.png' alt='paper' width='150'></div>-->
    <!--</div>-->
    <!--<hr>-->
    
    <!--<div class="row">-->
    <!--    <div class='col, matchWinner'><img src='img/rps-img/paper.png' alt='paper' width='150'></div>-->
    <!--    <div class='col'><img src='img/rps-img/rock.png' alt='rock' width='150'></div>-->
    <!--</div>-->
    <!--<hr>-->

    <div id="finalWinner">

        <h1>The winner is Player 2</h1>

    </div>
    Images source: https://www.kisspng.com/png-rockpaperscissors-game-money-4410819/
     
</body>

</html>
