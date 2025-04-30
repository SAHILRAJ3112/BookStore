<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <style>
    /* Modern styling */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .checkout-wrapper {
      display: flex;
      flex-wrap: wrap;
      max-width: 900px;
      width: 100%;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .cart-section {
      flex: 1;
      padding-right: 20px;
      max-height: 400px;
      overflow-y: auto;
    }
    .cart-summary { padding-bottom: 20px; }
    .form-section {
      flex: 1;
      padding-left: 20px;
      border-left: 1px solid #ddd;
    }
    .total-amount {
      background: #fff;
      padding: 10px;
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      color: #28a745;
      border-top: 1px solid #ddd;
      margin-top: 20px;
    }
    h2, h3 { text-align: center; color: #343a40; }
    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
    }
    .cart-item img {
      width: 50px;
      height: 50px;
      border-radius: 8px;
      margin-right: 10px;
    }
    .cart-item-controls {
      display: flex;
      gap: 5px;
    }
    .cart-item-controls button {
      background: #007bff;
      color: white;
      border: none;
      padding: 6px 12px;
      cursor: pointer;
      border-radius: 8px;
      font-size: 14px;
      transition: background 0.3s, transform 0.2s;
    }
    .cart-item-controls button:hover {
      background: #0056b3;
      transform: scale(1.1);
    }
    .remove-item { background: #dc3545; }
    .remove-item:hover { background: #a71d2a; }
    .user-details, .payment-details {
      margin-bottom: 15px;
    }
    .user-details input, .user-details textarea,
    .payment-details input {
      width: 100%;
      padding: 12px;
      margin-bottom: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }
    .payment-options {
      margin-bottom: 15px;
      text-align: center;
    }
    .payment-options label {
      margin-right: 10px;
      font-weight: bold;
    }
    .place-order {
      width: 100%;
      background: #28a745;
      color: #fff;
      border: none;
      padding: 12px;
      cursor: pointer;
      border-radius: 8px;
      font-size: 16px;
      transition: background 0.3s, transform 0.2s;
    }
    .place-order:hover {
      background: #218838;
      transform: scale(1.05);
    }
    @media (max-width: 768px) {
      .checkout-wrapper {
        flex-direction: column;
        padding: 15px;
      }
      .cart-section, .form-section { padding: 0; border: none; }
    }
  </style>
</head>
<body>
  <div class="checkout-wrapper">
    <div class="cart-section">
      <h2>Your Cart</h2>
      <div class="cart-summary" id="cartSummary"></div>
    </div>
    <div class="form-section">
      <h2>Checkout</h2>
      <div class="user-details">
        <input type="text" id="userName" placeholder="Full Name" required>
        <textarea id="userAddress" placeholder="Full Address (Street, City, State)" required></textarea>
        <input type="tel" id="userPhone" placeholder="Phone Number (10 digits)" required pattern="\d{10}" title="Please enter a valid 10-digit phone number">
        <input type="text" id="userPincode" placeholder="Pincode" required pattern="\d{6}" title="Please enter a valid 6-digit pincode">
        <input type="text" id="userArea" placeholder="Area" readonly>
      </div>
      <div class="payment-options">
        <label>Payment Method:</label>
        <input type="radio" name="paymentMethod" id="codOption" value="COD" checked>
        <label for="codOption">Cash on Delivery</label>
        <input type="radio" name="paymentMethod" id="onlineOption" value="Online">
        <label for="onlineOption">Online Payment</label>
      </div>
      <div class="payment-details" id="onlinePaymentDetails" style="display: none;">
        <input type="text" id="cardHolder" placeholder="Card Holder Name">
        <input type="text" id="cardNumber" placeholder="Card Number" pattern="\d{16}" title="Please enter a valid 16-digit card number">
        <input type="text" id="cardExpiry" placeholder="Expiry Date (MM/YY)" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Enter in MM/YY format">
        <input type="text" id="cardCVV" placeholder="CVV" pattern="\d{3}" title="Enter a valid 3-digit CVV">
      </div>
      <div class="total-amount">Total: Rs. <span id="totalAmount">0</span></div>
      <button class="place-order" onclick="placeOrder()">Place Order</button>
    </div>
  </div>
  
  <script>
    // Sample mapping for pincodes to area names.
    const pincodeToArea = {
      "560001": "Bangalore - MG Road",
      "110001": "New Delhi - Connaught Place",
      "400001": "Mumbai - Fort",
      "700001": "Kolkata - Central"
      // Add more mappings as needed.
    };
    
    // Auto-fill area based on entered pincode.
    document.getElementById("userPincode").addEventListener("blur", function() {
      const pincode = this.value;
      if (pincodeToArea[pincode]) {
        document.getElementById("userArea").value = pincodeToArea[pincode];
      } else {
        document.getElementById("userArea").value = "Area not found";
      }
    });
    
    // Toggle online payment fields.
    const onlineOption = document.getElementById("onlineOption");
    const codOption = document.getElementById("codOption");
    const onlinePaymentDetails = document.getElementById("onlinePaymentDetails");
    
    onlineOption.addEventListener("change", function() {
      if (onlineOption.checked) {
        onlinePaymentDetails.style.display = "block";
      }
    });
    codOption.addEventListener("change", function() {
      if (codOption.checked) {
        onlinePaymentDetails.style.display = "none";
      }
    });
    
    function getInventory() {
      return JSON.parse(localStorage.getItem("inventory")) || {};
    }
    function saveInventory(inv) {
      localStorage.setItem("inventory", JSON.stringify(inv));
    }
    function updateCheckoutPage() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      const cartSummary = document.getElementById("cartSummary");
      const totalAmount = document.getElementById("totalAmount");
      let total = 0;
      if (cart.length === 0) {
        cartSummary.innerHTML = "<p>Your cart is empty.</p>";
        totalAmount.textContent = "0";
        return;
      }
      cartSummary.innerHTML = cart.map((item, index) => `
          <div class="cart-item">
              <img src="${item.image}" alt="${item.title}">
              <span>${item.title} x ${item.quantity} = Rs. ${item.price * item.quantity}</span>
              <div class="cart-item-controls">
                  <button onclick="changeQuantity(${index}, -1)">-</button>
                  <button onclick="changeQuantity(${index}, 1)">+</button>
                  <button class="remove-item" onclick="removeItem(${index})">Remove</button>
              </div>
          </div>
      `).join('');
      total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
      totalAmount.textContent = total;
    }
    function changeQuantity(index, delta) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let item = cart[index];
      if (item.quantity + delta > 0) {
        let inventory = getInventory();
        const available = inventory[item.id] || 0;
        if (delta > 0 && item.quantity + delta > available) {
          alert("Not enough stock available for " + item.title + ". Available: " + available);
          return;
        }
        item.quantity += delta;
      } else {
        cart.splice(index, 1);
      }
      localStorage.setItem("cart", JSON.stringify(cart));
      updateCheckoutPage();
    }
    function removeItem(index) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      cart.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cart));
      updateCheckoutPage();
    }
    function placeOrder() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
      }
      // Validate user details.
      const userName = document.getElementById("userName").value.trim();
      const userAddress = document.getElementById("userAddress").value.trim();
      const userPhone = document.getElementById("userPhone").value.trim();
      const userPincode = document.getElementById("userPincode").value.trim();
      if(userPhone.length !== 10) {
        alert("Phone number must be exactly 10 digits.");
        return;
      }
      if(userPincode.length !== 6) {
        alert("Pincode must be exactly 6 digits.");
        return;
      }
      
      let inventory = getInventory();
      for (let item of cart) {
        if ((inventory[item.id] || 0) < item.quantity) {
          alert("Not enough stock available for " + item.title + ". Available: " + (inventory[item.id] || 0));
          return;
        }
      }
      for (let item of cart) {
        inventory[item.id] = (inventory[item.id] || 0) - item.quantity;
      }
      saveInventory(inventory);
      
      // Calculate total order amount.
      let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
      
      // Get payment method and details.
      const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
      let paymentDetails = { method: paymentMethod };
      if(paymentMethod === "Online") {
        const cardHolder = document.getElementById("cardHolder").value.trim();
        const cardNumber = document.getElementById("cardNumber").value.trim();
        const cardExpiry = document.getElementById("cardExpiry").value.trim();
        const cardCVV = document.getElementById("cardCVV").value.trim();
        if(!cardHolder || !cardNumber || !cardExpiry || !cardCVV) {
          alert("Please fill in all card details for online payment.");
          return;
        }
        paymentDetails = { 
          method: paymentMethod, 
          cardHolder, 
          cardNumber, 
          cardExpiry, 
          cardCVV 
        };
      }
      
      // Create order details.
      const order = {
        orderId: Date.now(),
        userName: userName,
        userAddress: userAddress,
        userPhone: userPhone,
        userPincode: userPincode,
        userArea: document.getElementById("userArea").value,
        payment: paymentDetails,
        cart: cart,
        total: total,
        timestamp: new Date().toISOString()
      };
      
      // Save order in localStorage.
      let orders = JSON.parse(localStorage.getItem("orders")) || [];
      orders.push(order);
      localStorage.setItem("orders", JSON.stringify(orders));
      
      alert("Order placed successfully!");
      localStorage.removeItem("cart");
      updateCheckoutPage();
    }
    updateCheckoutPage();
  </script>
</body>
</html>
