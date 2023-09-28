<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    file_put_contents('users.txt', "$username:$hashedPassword:$email\n", FILE_APPEND);
    header('Location: index.php');
    exit;
}
?>

<form method="post" action="register.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <button type="submit">Registruj se</button>
</form>
