<?php
// main Ludo class
require_once "LudoClass.php";


$ludoObj = new LudoClass();

if (!isset($_COOKIE['username'])) {
    header('Location: login.php');
    exit;
}
$username = $_COOKIE['username'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <title>Mensch ärgere Dich nicht [Ludo]</title> -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta http-equiv="Cache-Control" content="no-store" />    
</head>
<body>
    <h1 style="font-size : 30px; font-weight : 800; text-align : center;">LUDO GAME</h1>
    <div id="ground">
        <div id="main">
            <div class="home" id="home-top">
                <!-- <div id="red-home">Player 1</div> -->
                <div id="red-home">Player 1 (
                <span id="player1score"></span> )
                </div>
                

                <!-- <div id="green-home">Green Home</div> -->
            </div>
            <div id="dice-div">
                <input type="button" id="dice" value="CLICK HERE TO ROLL THE DICE">
                <div id="dice-result"></div>
            </div>
        </div>
        <div id="board">
            <?php
            // creating boxes for board
            for($y = 1;$y <= 15; $y++){
                for($x = 1; $x <= 15; $x++){
                    echo $ludoObj->createBoxes($x, $y);
                }
                echo "<br>";

            }

            ?>
        </div>
        <div id="all-stick-positions">
            <table id="positions">
                <thead><td colspan="5"><b>Select move for 4 pieces of each players</b></td></thead>
              
              
                <tr><td></td><td>Piece1</td><td>Piece2</td><td>Piece3</td><td>Piece4</td></tr>
                <tr id="redRow">
                    <td><div class="stick_position" ><b>Player1 (R)</b></div></td>
                    <td><div class="stick_position" id="position_r_1"></div></td>
                    <td><div class="stick_position" id="position_r_2"></div></td>
                    <td><div class="stick_position" id="position_r_3"></div></td>
                    <td><div class="stick_position" id="position_r_4"></div></td>
                </tr>

         
             
                <tr id="yellowRow">
                    <td><div class="stick_position" ><b>Player2 (Y)</b></div></td>
                    <td><div class="stick_position" id="position_y_1"></div></td>
                    <td><div class="stick_position" id="position_y_2"></div></td>
                    <td><div class="stick_position" id="position_y_3"></div></td>
                    <td><div class="stick_position" id="position_y_4"></div></td>
                </tr>
              
                <tr><td colspan="5"><hr></td></tr>
                <tr><td colspan="5"><small>Click on the specific box to give a move for that piece of that player. If dice result is 6 for that player only then he can move a piece from home [blank] and will get another dice role chance.<br>To start the game click on 'Refresh the whole game' button. Then click on dice. As per dice result [player] click on specific position boxes above. See that peice movement at board. If you have only one piece waiting to end the game. But not getting exact move to reach the end then your piece will remain there until getting exact dice result.</small></td></tr>
            </table>
            <br>
            <div id="move_result"></div>
            
        </div>
        <div><input id="refresh" type="button" value="RE-INITIALIZE THE GAME"></div>
        <div class="home" id="home-down">
            <!-- <div id="blue-home">Blue Home</div> -->
            <div id="yellow-home">Player 2 (
                <span id="player2score"></span> )
        </div>
        <br clear="all">
       
    </div>
</body>
    <script src="ludo.js" type="text/javascript"></script>
</html>