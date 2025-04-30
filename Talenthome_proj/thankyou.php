<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .thank-you-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
        }

        h2 {
            color: #28a745;
        }

        .order-details {
            margin-top: 15px;
            font-size: 18px;
        }

        .home-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="thank-you-container">
        <h2>🎉 Thank You for Your Order! 🎉</h2>
        <p>Your order has been successfully placed.</p>

        <div class="order-details">
            <p><strong>Total Amount:</strong> Rs. <span id="orderTotal">0</span></p>
            <p><strong>Payment Method:</strong> <span id="paymentMethod">N/A</span></p>
        </div>

        <button class="home-button" onclick="goHome()">Back to Home</button>
    </div>

    <script>
        function loadOrderDetails() {
    let orderTotal = localStorage.getItem("orderTotal");
    let paymentMethod = localStorage.getItem("paymentMethod");

    // Prevent displaying "0" if order total is missing
    if (!orderTotal || orderTotal === "0") {
        orderTotal = "N/A"; 
    }
    if (!paymentMethod) {
        paymentMethod = "N/A";
    }

    document.getElementById("orderTotal").textContent = orderTotal;
    document.getElementById("paymentMethod").textContent = paymentMethod;

    // Clear cart and order details only AFTER they are displayed
    setTimeout(() => {
        localStorage.removeItem("orderTotal");
        localStorage.removeItem("paymentMethod");
        localStorage.removeItem("cart"); // Ensure cart is reset
    }, 3000); // Delay clearing for 3 seconds to ensure visibility

    // Countdown for redirection
    let countdown = 5;
    let timer = setInterval(() => {
        countdown--;
        document.getElementById("countdown").textContent = countdown;
        if (countdown === 0) {
            clearInterval(timer);
            goHome();
        }
    }, 1000);
}

function goHome() {
    window.location.href = "bbacasem3.php"; // Change this to your home page
}

window.onload = loadOrderDetails;

    </script>

</body>
</html>
