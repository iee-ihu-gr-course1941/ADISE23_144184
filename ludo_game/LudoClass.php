<?php
require_once 'Database.php';
/**
 * Class Ludo
 */
class LudoClass
{
    // this is main board ids of the ludo game
    public $noNeedBoxes = array('0802','0803', '0804', '0805','0806', '0807', '0809', '0810', '0811', '0812', '0813', '0814',  '0101', '0201', '0301', '0401', '0102', '0202', '0302', '0402', '0103', '0203', '0303', '0403', '0104', '0204', '0304', '0404', '1201', '1301', '1401', '1501', '1202', '1302', '1402', '1502', '1203', '1303', '1403', '1503', '1204', '1304', '1404', '1504', '0112', '0212', '0312', '0412', '0113', '0213', '0313', '0413', '0114', '0214', '0314', '0414', '0115', '0215', '0315', '0415', '1212', '1312', '1412', '1512', '1213', '1313', '1413', '1513', '1214', '1314', '1414', '1514', '1215', '1315', '1415', '1515', '0505', '0206', '0306', '0406', '0506', '0606', '0706', '0906', '1006', '1106', '1206', '1306', '1406', '1105', '0207', '0307', '0407', '0507', '0607', '0707', '0907', '1007', '1107', '1207', '1307', '1407', '0209', '0309', '0409', '0509', '0609', '0709', '0909', '1009', '1109', '1209', '1309', '1409', '0210', '0310', '0410', '0510', '0610', '0710', '0511', '0910', '1010', '1110', '1210', '1310', '1410', '1111', '0602', '0603', '0604', '0605', '0702', '0703', '0704', '0705', '0902', '0903', '0904', '0905', '1002', '1003', '1004', '1005', '0611', '0612', '0613', '0614', '0711', '0712', '0713', '0714', '0911', '0912', '0913', '0914', '1011', '1012', '1013', '1014', '0808');

    public $players = array('red',  'yellow');

    function __construct() {
        $database = new Database();
        $pdo = $database->getPDO();

        // Check if game state exists in the database
        $stmt = $pdo->prepare("SELECT key_name, value FROM ludo_game_state");
        $stmt->execute();
        $results = $stmt->fetchAll();

        if ($results) {
            // Load game state from the database
            foreach ($results as $row) {
                $_SESSION[$row['key_name']] = unserialize($row['value']);
            }
        } else {
            // Initialize game state
            $this->initializeGameState($pdo);
        }
    }

    function initializeGameState($pdo) {
        // ... Initialize your game state ...
        // Example:
        $_SESSION['redBoxArea'] = array('0208', '0308', '0408', '0508', '0608', '0708');
        $_SESSION['yellowBoxArea'] =  array('0908', '1008', '1108', '1208', '1308', '1408');
        // $_SESSION['greenBoxArea'] =  array('0802', '0803', '0804', '0805', '0806', '0807');

        $_SESSION['redFirstPosition'] = '0105';
        // $_SESSION['blueFirstPosition'] = '0515';
        $_SESSION['yellowFirstPosition'] = '1511';
        // $_SESSION['greenFirstPosition'] = '1101';

        $_SESSION['redpieceNotInGame'] = array();
        // $_SESSION['bluepieceNotInGame'] = array();
        $_SESSION['yellowpieceNotInGame'] = array();
        // $_SESSION['greenpieceNotInGame'] = array();

// moves for each players
        $_SESSION['redPositionsToMove'] = array('0105', '0205', '0305', '0405', '0504', '0503', '0502', '0501', '0601', '0701', '0801', '0901', '1001', '1101', '1102', '1103', '1104', '1205', '1305', '1405', '1505', '1506', '1507', '1508', '1509', '1510', '1511', '1411', '1311', '1211', '1112', '1113', '1114', '1115', '1015', '0915', '0815', '0715', '0615', '0515', '0515', '0514', '0513', '0512', '0411', '0311', '0211', '0111', '0110', '0109', '0108', '0208', '0308', '0408', '0508', '0608', '0708', '-1');
        // $_SESSION['bluePositionsToMove'] = array('0515', '0514', '0513', '0512', '0411', '0311', '0211', '0111', '0110', '0109', '0108', '0107', '0106', '0105', '0205', '0305', '0405', '0504', '0503', '0502', '0501', '0601', '0701', '0801', '0901', '1001', '1101', '1102', '1103', '1104', '1205', '1305', '1405', '1505', '1506', '1507', '1508', '1509', '1510', '1511', '1411', '1311', '1211', '1112', '1113', '1114', '1115', '1015', '0915', '0815', '0814', '0813', '0812', '0811', '0810', '0809', '-1');
        $_SESSION['yellowPositionsToMove'] = array('1511', '1411', '1311', '1211', '1112', '1113', '1114', '1115', '1015', '0915', '0815', '0715', '0615', '0515', '0514', '0513', '0512', '0411', '0311', '0211', '0111', '0110', '0109', '0108', '0107', '0106', '0105', '0205', '0305', '0405', '0504', '0503', '0502', '0501', '0601', '0701', '0801', '0901', '1001', '1101', '1102', '1103', '1104', '1205', '1305', '1405', '1505', '1506', '1507', '1508', '1408', '1308', '1208', '1108', '1008', '0908', '-1');
        // ... other initializations ...

        // Save initial game state to the database
        foreach ($_SESSION as $key => $value) {
            $stmt = $pdo->prepare("INSERT INTO ludo_game_state (key_name, value) VALUES (:key_name, :value)");
            $stmt->execute(['key_name' => $key, 'value' => serialize($value)]);
        }
    }

    /**
     * this function will create main board for game
     * @param $x
     * @param $y
     * @return string
     */
     function createBoxes ($x, $y) {

        if ($x < 10) {
            $x = '0' . $x;
        }

        if ($y < 10) {
            $y = '0' . $y;
        }
        // echo $x . $y . '<br>';
        // this box not required to create board
        if (in_array($x.$y, $this->noNeedBoxes)) {
            return '<div class="box-hide" id="box_'.$x.$y.'"></div>';
        } else {
            if($x == 15 && $y == 11){
                return '<div class="box " style="background-color : yellow;" id="box_'.$x.$y.'"></div>';
            }

            if($x == 01 && $y == 05){
                return '<div class="box " style="background-color : red;" id="box_'.$x.$y.'"></div>';
            }
            
            return '<div class="box" id="box_'.$x.$y.'"></div>';

            
        }

    }
}