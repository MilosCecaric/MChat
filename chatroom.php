<?php
session_start();

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

function getMessages() {
    $messages = file('messages.txt', FILE_IGNORE_NEW_LINES);
    return $messages;
}

function saveMessage($username, $message) {
    file_put_contents('messages.txt', "$username: $message\n", FILE_APPEND);
}

if (!isUserLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    if (!empty($message)) {
        saveMessage($_SESSION['username'], $message);
    }
}

$messages = getMessages();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHAT</title>
</head>
<body>
    <h1>Hello, <?php echo $_SESSION['username']; ?>!</h1>
    
    <div id="messages">
        <?php foreach ($messages as $message) { ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php } ?>
    </div>
    
    <form method="post" action="chatroom.php">
        <input type="text" name="message" placeholder="Unesite poruku" required>
        <button type="submit">Send</button>
    </form>
</body>
</html>
