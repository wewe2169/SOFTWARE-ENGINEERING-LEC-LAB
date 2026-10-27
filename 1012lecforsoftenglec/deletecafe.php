<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php $cafe = getCafeByID($pdo, $_GET['cafe_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Cafe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this cafe?</h1>
    <div class="card delete-card">
        <h2><?php echo htmlspecialchars($cafe['cafe_name']); ?></h2>
        <p>Address: <?php echo htmlspecialchars($cafe['address']); ?></p>
        <p style="color: #D84315;"><strong>Warning:</strong> Deleting this cafe will also delete all of its recorded orders.</p>
        
        <form action="core/handleForms.php" method="POST" style="box-shadow:none; padding:0; border:none;">
            <input type="hidden" name="cafe_id" value="<?php echo $cafe['cafe_id']; ?>">
            <input type="submit" name="deleteCafeBtn" value="Yes, Delete" style="background-color: #D84315;">
            <a href="index.php" style="display:block; text-align:center; margin-top:10px;">Cancel</a>
        </form>
    </div>
</body>
</html>