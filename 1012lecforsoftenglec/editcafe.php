<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php $cafe = getCafeByID($pdo, $_GET['cafe_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Cafe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">← Return to Home</a>
    <h1>Edit Cafe Details</h1>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="cafe_id" value="<?php echo $cafe['cafe_id']; ?>">
        <p>
            <label>Cafe Name:</label> 
            <input type="text" name="cafe_name" value="<?php echo htmlspecialchars($cafe['cafe_name']); ?>" required>
        </p>
        <p>
            <label>Address:</label> 
            <input type="text" name="address" value="<?php echo htmlspecialchars($cafe['address']); ?>" required>
        </p>
        <input type="submit" name="editCafeBtn" value="Update Cafe">
    </form>
</body>
</html>
