<?php
require_once 'Database.php';

class CustomSessionHandler {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getPDO();
        session_set_save_handler(
            [$this, 'open'],
            [$this, 'close'],
            [$this, 'read'],
            [$this, 'write'],
            [$this, 'destroy'],
            [$this, 'gc']
        );
        session_start();
    }

    public function setSessionData($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function getSessionData($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function unsetSessionData($key) {
        unset($_SESSION[$key]);
    }

    public function destroySession() {
        session_destroy();
    }

    public function open($savePath, $sessionName) {
        return true;
    }

    public function close() {
        return true;
    }

    public function read($session_id) {
        $stmt = $this->pdo->prepare("SELECT data FROM game_sessions WHERE session_id = :session_id");
        $stmt->execute(['session_id' => "38rr4ajif0l13e81rc27epkeoq"]);
        if ($row = $stmt->fetch()) {
            return $row['data'];
        }
        return '';
    }

    public function write($session_id, $data) {
        $stmt = $this->pdo->prepare("REPLACE INTO game_sessions (session_id, data) VALUES (:session_id, :data)");
        $stmt->execute(['session_id' => "38rr4ajif0l13e81rc27epkeoq", 'data' => $data]);
        return true;
    }

    public function destroy($session_id) {
        $stmt = $this->pdo->prepare("DELETE FROM game_sessions WHERE session_id = :session_id");
        $stmt->execute(['session_id' => "38rr4ajif0l13e81rc27epkeoq"]);
        return true;
    }

    public function gc($maxlifetime) {
        $stmt = $this->pdo->prepare("DELETE FROM game_sessions WHERE last_access < DATE_SUB(NOW(), INTERVAL :maxlifetime SECOND)");
        $stmt->execute(['maxlifetime' => $maxlifetime]);
        return true;
    }
}
?>
