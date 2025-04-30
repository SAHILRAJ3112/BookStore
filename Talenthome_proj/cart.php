<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); 
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="cartApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cart-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .cart-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .cart-item:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .cart-item img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
            transition: transform 0.3s;
        }
        .cart-item img:hover {
            transform: scale(1.1);
        }
        .cart-item button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .cart-item button:hover {
            background: #c82333;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body ng-controller="cartCtrl">
    <div class="container">
        <h2>Your Shopping Cart</h2>
        <div class="cart-grid" ng-if="cart.length > 0">
            <div class="cart-item" ng-repeat="item in cart">
                <img ng-src="{{item.imgpath}}" alt="{{item.bname}}">
                <h3>{{item.bname}}</h3>
                <p>Quantity: {{item.qty}}</p>
                <p>Price: Rs. {{item.bprice}}</p>
                <p>Total: Rs. {{item.qty * item.bprice}}</p>
                <form method="post" action="">
                    <input type="hidden" name="remove_id" value="{{item.id}}">
                    <button type="submit">Remove</button>
                </form>
            </div>
        </div>
        <p ng-if="cart.length === 0">Your cart is empty</p>
        <div class="total" ng-if="cart.length > 0">Total: Rs. {{getTotal()}}</div>
    </div>

    <script>
        var app = angular.module("cartApp", []);
        app.controller("cartCtrl", function($scope) {
            $scope.cart = <?php echo json_encode($_SESSION['cart'] ?? []); ?>;
            
            $scope.getTotal = function() {
                return $scope.cart.reduce((sum, item) => sum + (item.qty * item.bprice), 0);
            };
        });
    </script>
</body>
</html>