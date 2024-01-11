<?php
// Start session
// session_start();

// Include database connection file (update with your database details)
require_once 'Database.php';

// Variable to hold any error message
$errorMessage = '';
$database = new Database();
$pdo = $database->getPDO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the statement using PDO
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($password == $row['password']) {
            // $_SESSION['user_id'] = $row['id'];
            // $_SESSION['username'] = $row['username'];

            setcookie('username', $row['username'], time() + (86400 * 30), "/");
            header("Location: index.php");
            exit();
        } else {
            $errorMessage = 'Incorrect password.';
        }
    } else {
        $errorMessage = 'Username not found.';
    }
}

// Retrieve username from cookie if set
$savedUsername = '';
if (isset($_COOKIE['username'])) {
    $savedUsername = $_COOKIE['username'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Ludo Game</title>
    <!-- Add any required styles -->
</head>
<body>
    <h2>Login to Play Ludo</h2>

    <?php
    if ($errorMessage != '') {
        echo "<p style='color:red;'>$errorMessage</p>";
    }
    ?>

    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($savedUsername); ?>" required><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>

    <h2>LOGIN CREDENTIALS</h2>
    <h4>PLAYER 1</h4>
    <p>USERNAME : Player1</p>
    <p>PASSWORD : 12345678</p>
    <br>
    <h4>PLAYER 2</h4>
    <p>USERNAME : Player2</p>
    <p>PASSWORD : 12345678</p>
</body>
</html>
