<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php $order = getOrderByID($pdo, $_GET['order_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this order?</h1>
    <div class="card delete-card">
        <p><strong>Customer:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
        <p><strong>Menu Item:</strong> <?php echo htmlspecialchars($order['menu_item']); ?></p>
        <p><strong>Total Amount:</strong> ₱<?php echo htmlspecialchars($order['total_amount']); ?></p>
        
        <form action="core/handleForms.php" method="POST" style="box-shadow:none; padding:0; border:none;">
            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
            <input type="hidden" name="cafe_id" value="<?php echo $_GET['cafe_id']; ?>">
            <input type="submit" name="deleteOrderBtn" value="Yes, Delete" style="background-color: #D84315;">
            <a href="vieworders.php?cafe_id=<?php echo $_GET['cafe_id']; ?>" style="display:block; text-align:center; margin-top:10px;">Cancel</a>
        </form>
    </div>
</body>
</html>


