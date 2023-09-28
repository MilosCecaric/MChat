<?php
session_start();

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($savedUsername, $hashedPassword, $savedEmail) = explode(':', $user);
        if ($username === $savedUsername && $email === $savedEmail && password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            break;
        }
    }
}

if (isUserLoggedIn()) {
    header('Location: chatroom.php');
    exit;
}
?>

<form method="post" action="index.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Log in</button>
</form>
