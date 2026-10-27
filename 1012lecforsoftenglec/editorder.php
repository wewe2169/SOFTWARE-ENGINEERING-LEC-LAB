<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php $order = getOrderByID($pdo, $_GET['order_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="vieworders.php?cafe_id=<?php echo $_GET['cafe_id']; ?>">← Back to Orders</a>
    <h1>Edit Order</h1>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
        <input type="hidden" name="cafe_id" value="<?php echo $_GET['cafe_id']; ?>">
        <p>
            <label>Menu Item:</label> 
            <input type="text" name="menu_item" value="<?php echo htmlspecialchars($order['menu_item']); ?>" required>
        </p>
        <p>
            <label>Customer Name:</label> 
            <input type="text" name="customer_name" value="<?php echo htmlspecialchars($order['customer_name']); ?>" required>
        </p>
        <p>
            <label>Total Amount (₱):</label> 
            <input type="number" step="0.01" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount']); ?>" required>
        </p>
        <input type="submit" name="editOrderBtn" value="Update Order">
    </form>
</body>
</html>
