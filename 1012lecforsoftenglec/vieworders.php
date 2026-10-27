<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'core/dbConfig.php';
require_once 'core/models.php';
$cafe = getCafeByID($pdo, $_GET['cafe_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders for <?php echo htmlspecialchars($cafe['cafe_name']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">← Return to Home</a>
    <h1>Orders for: <?php echo htmlspecialchars($cafe['cafe_name']); ?></h1>
    
    <h2>Add a New Order</h2>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="cafe_id" value="<?php echo $_GET['cafe_id']; ?>">
        <p>
            <label>Menu Item (e.g., Espresso, Latte):</label> 
            <input type="text" name="menu_item" required>
        </p>
        <p>
            <label>Customer Name:</label> 
            <input type="text" name="customer_name" required>
        </p>
        <p>
            <label>Total Amount (₱):</label> 
            <input type="number" step="0.01" name="total_amount" required>
        </p>
        <input type="submit" name="insertOrderBtn" value="Add Order">
    </form>

    <h2>Order List</h2>
    <table style="width:100%; margin-top: 50px;">
        <tr>
            <th>Order ID</th>
            <th>Menu Item</th>
            <th>Customer Name</th>
            <th>Total Amount</th>
            <th>Added By</th>
            <th>Last Updated By</th>
            <th>Actions</th>
        </tr>
        <?php $getOrdersByCafe = getOrdersByCafe($pdo, $_GET['cafe_id']); ?>
        <?php foreach ($getOrdersByCafe as $row) { ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo htmlspecialchars($row['menu_item']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
            <td>₱<?php echo htmlspecialchars($row['total_amount']); ?></td>
            <td><?php echo htmlspecialchars($row['added_by']); ?></td>
            <td><?php echo htmlspecialchars($row['last_updated']); ?></td>
            <td>
                <a href="editorder.php?order_id=<?php echo $row['order_id']; ?>&cafe_id=<?php echo $_GET['cafe_id']; ?>">Edit</a>
                <a href="deleteorder.php?order_id=<?php echo $row['order_id']; ?>&cafe_id=<?php echo $_GET['cafe_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>