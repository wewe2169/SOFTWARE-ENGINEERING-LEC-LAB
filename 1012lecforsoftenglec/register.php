<?php
require_once 'core/dbConfig.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, address, age, username, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$first_name, $last_name, $address, $age, $username, $hashed_password]);
            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            $message = "Registration failed: Username might already exist.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Cafe Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div style="max-width: 450px; margin: 50px auto;">
        <h2>Register User</h2>
        <?php if($message): ?><p style="color:red;"><?php echo $message; ?></p><?php endif; ?>
        <form method="POST" style="box-shadow: 0px 4px 12px rgba(62, 39, 35, 0.08); padding: 25px; background: #fff; border-radius: 10px;">
            <p><label>First Name:</label><input type="text" name="first_name" required></p>
            <p><label>Last Name:</label><input type="text" name="last_name" required></p>
            <p><label>Address:</label><input type="text" name="address" required></p>
            <p><label>Age:</label><input type="number" name="age" required></p>
            <p><label>Username:</label><input type="text" name="username" required></p>
            
            <p>
                <label>Password:</label>
                <input type="password" name="password" id="regPassword" required>
                <br><input type="checkbox" onclick="toggleRegPassword()" style="margin-top: 5px;"> Show Password
            </p>

            <p>
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirmPassword" required>
                <br><input type="checkbox" onclick="toggleConfirmPassword()" style="margin-top: 5px;"> Show Password
            </p>

            <input type="submit" value="Register">
        </form>
        <p style="margin-top: 15px;">Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
    function toggleRegPassword() {
        var x = document.getElementById("regPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function toggleConfirmPassword() {
        var y = document.getElementById("confirmPassword");
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }
    </script>
</body>
</html>