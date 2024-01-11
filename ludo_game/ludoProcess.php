<?php
// main Ludo class
require_once "LudoClass.php";
require_once 'CustomSessionHandler.php';

$sessionHandler = new CustomSessionHandler();
$ludoObj = new LudoClass();
// initializeOrRestoreGameState($ludoObj, $sessionHandler);
// echo "Session Values:<br>";
// foreach ($_SESSION as $key => $value) {
//     echo $key;
//     print_r($value);
// }
// ajax api request capture
$post = json_decode($_POST['data']);

if (isset($post->action) && !empty($post->action)) {

    $action = $post->action;

    switch ($action) {
        case 'diceRoll' : diceRollAction($ludoObj, $sessionHandler);
            break;
        case 'move' : moveAction($post, $ludoObj, $sessionHandler);
            break;
        case 'refresh' : refreshAction($ludoObj);
            break;
    }
}


/**
 *  this function will randomly generate dice result for specific player
 */
function diceRollAction($ludoObj, $sessionHandler) {
    $player = null;

    // Check who's turn it is
    $turn = $sessionHandler->getSessionData('turn');
    $lastResult = $sessionHandler->getSessionData('last_result');

    if (!isset($turn)) {
        $sessionHandler->setSessionData('last_result', 0);
        $sessionHandler->setSessionData('turn', 0);
        $turn = 0;
        $player = $ludoObj->players[$turn];
    } else {
        if ($turn >= 1 && $lastResult < 6) {
            $player = $ludoObj->players[0];
            $sessionHandler->setSessionData('turn', 0);
        } elseif ($lastResult == 6) {
            $player = $ludoObj->players[$turn];
        } else {
            $turn++;
            $sessionHandler->setSessionData('turn', $turn);
            $player = $ludoObj->players[$turn];
        }
    }

    // Random number from 1 to 6
    $result = rand(1,6);

    // Update the last result in the session
    $sessionHandler->setSessionData('last_result', $result);

    // Output the result
    // if(ucfirst($player) == 'Yellow')
      echo 'Turn' . ' : ' . $result;
}


/**
 * this will check for every move requesting by player for a specific piece
 * @param $post
 * @param $ludoObj
 */
function moveAction($post, $ludoObj, $sessionHandler) {
    $boxId = $post->boxId;
    $currentValue = $post->currentValue;

    $boxIdDetails = explode('_', $boxId);
    $player = null;

    // Check move for which player
    switch ($boxIdDetails[1]) {
        case 'r':
            $player = 0;
            break;
        case 'y':
            $player = 1;
            break;

    }

    $turn = $sessionHandler->getSessionData('turn');
    $lastResult = $sessionHandler->getSessionData('last_result');
    $playerNotInGameKey = $ludoObj->players[$player] . 'pieceNotInGame';

    // Check if this move is for the specific player on which it is requested to move for
    if (count($boxIdDetails) > 0 && $boxIdDetails[1] == substr($ludoObj->players[$turn], 0, 1)) {

        // Is it a first move for the home piece
        if ($lastResult == 6 && $currentValue == '' && (!in_array($boxIdDetails[2], $sessionHandler->getSessionData($playerNotInGameKey)))) {

            $sessionHandler->setSessionData($ludoObj->players[$player].$boxIdDetails[2].'LatestPosition', $sessionHandler->getSessionData($ludoObj->players[$player].'FirstPosition'));
            echo $sessionHandler->getSessionData($ludoObj->players[$player].$boxIdDetails[2].'LatestPosition');

        } elseif (strlen($currentValue) === 4 || ($currentValue != '' && (!in_array($boxIdDetails[2], $sessionHandler->getSessionData($playerNotInGameKey))))) {

            $details = array(
                'player' => $ludoObj->players[$player],
                'piece' => $boxIdDetails[2],
                'latestPosition' => $currentValue
            );

            // Call next move function to calculate if not the first move for that piece
            nextMove($details, $sessionHandler);

        } elseif ($currentValue == '' && $lastResult < 6 && (!in_array($boxIdDetails[2], $sessionHandler->getSessionData($playerNotInGameKey)))) {
            echo 'This piece needs 6 to move out from home. Try another piece.';
        } elseif ($currentValue == -1) {
            // Remove that piece from the game
            $piecesNotInGame = $sessionHandler->getSessionData($playerNotInGameKey);
            $piecesNotInGame[] = $boxIdDetails[2];
            $sessionHandler->setSessionData($playerNotInGameKey, $piecesNotInGame);
            echo 'This piece already reached the end. Choose another piece for this player.';
        }
    } else {
        echo 'Wrong player trying to move. This is for player '. ucfirst($ludoObj->players[$turn]);
    }
}


/**
 * this will calculate what will be next position for that piece
 * @param $details
 */
function nextMove($details, $sessionHandler) {
    $latestPosition = $details['latestPosition']; // current position for the stick/piece
    $needToMove = $sessionHandler->getSessionData('last_result'); // dice roll out result
    $positions = $sessionHandler->getSessionData($details['player'].'PositionsToMove'); // all positions for this player

    $toMove = 0;
    $nowMoveCountStart = 0;
    $reached = 0;

    // Loop through all positions for this player's specific piece
    foreach ($positions as $position) {

        // Determine current position
        if ($position === $latestPosition && $nowMoveCountStart == 0) {
            $nowMoveCountStart = 1;
            $toMove++;

        // Check if it reaches the point to move from the last point/box
        } elseif ($toMove == $needToMove && $nowMoveCountStart == 1) {
            $reached = 1;
            $play = 'red';
            $score = 'player2score';
            if($details['player'] == 'red'){
                $play = 'yellow'; 
                $score = 'player1score';
            }

            if($position != 1511 || $position != 0105){
              
                if($position == $sessionHandler->getSessionData($play.'1LatestPosition')){
                    $sessionHandler->setSessionData($play.'1LatestPosition', '');
                    $sessionHandler->setSessionData($score, $sessionHandler->getSessionData($score) + 10);
                }
                else if($position == -1){
                    $sessionHandler->setSessionData($score, $sessionHandler->getSessionData($score) + 10);
                }
                else if($position == $sessionHandler->getSessionData($play.'2LatestPosition')){
                    $sessionHandler->setSessionData($play.'2LatestPosition', '');
                    $sessionHandler->setSessionData($score, $sessionHandler->getSessionData($score) + 10);
                }
                else if($position == $sessionHandler->getSessionData($play.'3LatestPosition')){
                    $sessionHandler->setSessionData($play.'3LatestPosition', '');
                    $sessionHandler->setSessionData($score, $sessionHandler->getSessionData($score) + 10);
                }
                else if($position == $sessionHandler->getSessionData($play.'4LatestPosition')){
                    $sessionHandler->setSessionData($play.'4LatestPosition', '');
                    $sessionHandler->setSessionData($score, $sessionHandler->getSessionData($score) + 10);
                }   
            }
            $sessionHandler->setSessionData($details['player'].$details['piece'].'LatestPosition', $position);
            break;

        // Increment the move counter
        } elseif ($nowMoveCountStart == 1) {
            $toMove++;
        }
    }

    // Remain in the same place if it didn't get the exact move to reach the end
    if ($reached === 0) {
        $sessionHandler->setSessionData($details['player'].$details['piece'].'LatestPosition', $latestPosition);
    }

    // Output the latest position
    echo $sessionHandler->getSessionData($details['player'].$details['piece'].'LatestPosition');
}


/**
 * refresh the game with destroying all existing sessions
 * @return bool
 */
function refreshAction () {
    session_destroy();
    return true;

    // return true;
}
    

