<?php
require_once 'dbConfig.php';

// CAFE FUNCTIONS (Parent)
function insertCafe($pdo, $cafe_name, $address, $username) {
    $sql = "INSERT INTO cafe (cafe_name, address, added_by, last_updated) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$cafe_name, $address, $username, $username]);
}

function getAllCafes($pdo) {
    $sql = "SELECT * FROM cafe";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCafeByID($pdo, $cafe_id) {
    $sql = "SELECT * FROM cafe WHERE cafe_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cafe_id]);
    return $stmt->fetch();
}

function updateCafe($pdo, $cafe_id, $cafe_name, $address, $username) {
    $sql = "UPDATE cafe SET cafe_name = ?, address = ?, last_updated = ? WHERE cafe_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$cafe_name, $address, $username, $cafe_id]);
}

function deleteCafe($pdo, $cafe_id) {
    $sql = "DELETE FROM cafe WHERE cafe_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$cafe_id]);
}

// ORDER FUNCTIONS (Child)
function getOrdersByCafe($pdo, $cafe_id) {
    $sql = "SELECT * FROM orders WHERE cafe_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cafe_id]);
    return $stmt->fetchAll();
}

function insertOrder($pdo, $menu_item, $customer_name, $total_amount, $cafe_id, $username) {
    $sql = "INSERT INTO orders (menu_item, customer_name, total_amount, cafe_id, added_by, last_updated) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$menu_item, $customer_name, $total_amount, $cafe_id, $username, $username]);
}

function getOrderByID($pdo, $order_id) {
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$order_id]);
    return $stmt->fetch();
}

function updateOrder($pdo, $order_id, $menu_item, $customer_name, $total_amount, $username) {
    $sql = "UPDATE orders SET menu_item = ?, customer_name = ?, total_amount = ?, last_updated = ? WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$menu_item, $customer_name, $total_amount, $username, $order_id]);
}

function deleteOrder($pdo, $order_id) {
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$order_id]);
}
?>