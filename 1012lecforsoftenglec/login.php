<?php
session_start();
require_once 'core/dbConfig.php';

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Cafe Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div style="max-width: 450px; margin: 50px auto;">
        <h2>Login</h2>
        <?php if($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
        <form method="POST" style="box-shadow: 0px 4px 12px rgba(62, 39, 35, 0.08); padding: 25px; background: #fff; border-radius: 10px;">
            <p><label>Username:</label><input type="text" name="username" required></p>
            <p>
                <label>Password:</label>
                <input type="password" name="password" id="loginPassword" required>
                <input type="checkbox" onclick="toggleLoginPassword()" style="margin-top: 8px;"> Show Password
            </p>
            <input type="submit" value="Login">
        </form>
        <p style="margin-top: 15px;">Don't have an account? <a href="register.php">Register here</a></p>
    </div>

    <script>
    function toggleLoginPassword() {
        var x = document.getElementById("loginPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
</body>
</html>