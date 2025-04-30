<?php
session_start();

// Check if the action is to add to cart
if ($_POST['action'] == 'addToCart') {
    $item = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'img' => $_POST['img'],
        'qty' => $_POST['qty']
    ];

    // Check if the cart already exists in the session, if not initialize it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add or update item in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $item['id']) {
            $cartItem['qty'] += $item['qty']; // Update quantity if already in cart
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $item; // Add new item to cart
    }

    echo json_encode($item); // Return added item back to front-end
}

// Handle fetching the cart data
if ($_GET['action'] == 'getCart') {
    echo json_encode(['cart' => isset($_SESSION['cart']) ? $_SESSION['cart'] : []]);
}
?>
