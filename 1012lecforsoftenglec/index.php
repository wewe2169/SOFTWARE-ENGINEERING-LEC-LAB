<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'core/dbConfig.php';
require_once 'core/models.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cafe Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Welcome to the Cafe Management System, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <a href="logout.php" style="background: #D84315; color: #fff; padding: 8px 15px; border-radius: 5px;">Logout</a>
    </div>
    
    <h2>Add a New Cafe</h2>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label>Cafe Name:</label> 
            <input type="text" name="cafe_name" required>
        </p>
        <p>
            <label>Address:</label>
            <input type="text" name="address" required>
        </p>
        <input type="submit" name="insertCafeBtn" value="Add Cafe">
    </form>

    <h2>List of Cafes</h2>
    <div class="card-container">
        <?php $cafes = getAllCafes($pdo); ?>
        <?php foreach ($cafes as $row) { ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($row['cafe_name']); ?></h3>
            <p>Address: <?php echo htmlspecialchars($row['address']); ?></p>
            <p><small>Added by: <?php echo htmlspecialchars($row['added_by']); ?></small></p>
            <p><small>Last updated by: <?php echo htmlspecialchars($row['last_updated']); ?></small></p>
            <div class="actions">
                <a href="vieworders.php?cafe_id=<?php echo $row['cafe_id']; ?>">View Orders</a>
                <a href="editcafe.php?cafe_id=<?php echo $row['cafe_id']; ?>">Edit</a>
                <a href="deletecafe.php?cafe_id=<?php echo $row['cafe_id']; ?>">Delete</a>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>