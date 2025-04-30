<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bookstore</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Roboto', sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    .container {
      display: flex;
      padding: 20px;
    }
    .book-list {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      width: 80%;
    }
    .book-card {
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
      padding: 15px;
      text-align: center;
      transition: transform 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    /* Slight scale on hover for the entire card */
    .book-card:hover {
      transform: scale(1.03);
    }

    /* === FLIP ANIMATION FOR THE IMAGE === */
    .flip-container {
      perspective: 1000px; /* enables 3D effect */
      width: 100%;
      height: 200px; /* same as your image height */
      margin-bottom: 10px;
      position: relative;
    }
    .flip-card {
      width: 100%;
      height: 100%;
      position: relative;
      transform-style: preserve-3d;
      transition: transform 0.6s ease;
    }
    /* On hover, rotate the card 180deg */
    .flip-container:hover .flip-card {
      transform: rotateY(180deg);
    }
    .flip-front, .flip-back {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      border-radius: 8px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .flip-front img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .flip-back {
      background: #fff;
      flex-direction: column;
      transform: rotateY(180deg);
      padding: 10px;
    }
    /* =============================== */

    .book-card h3 {
      margin: 10px 0;
      font-size: 18px;
      color: #333;
    }
    .book-card p {
      font-size: 16px;
      color: #555;
      font-weight: bold;
    }
    .stock-info {
      font-size: 14px;
      margin-bottom: 8px;
    }
    .out-of-stock {
      color: red;
      font-weight: bold;
    }
    .add-to-cart {
      background: linear-gradient(135deg, #4A90E2, #357ABD);
      color: #fff;
      border: none;
      padding: 10px 15px;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .add-to-cart:hover {
      background: linear-gradient(135deg, #357ABD, #2C659E);
    }
    /* Cart sidebar (unchanged) */
    .cart {
      width: 270px;
      position: fixed;
      right: -340px;
      top: 0;
      height: 100vh;
      background: #fff;
      box-shadow: -5px 0 10px rgba(0,0,0,0.2);
      padding: 20px;
      transition: right 0.4s;
      overflow-y: auto;
    }
    .cart.open {
      right: 0;
    }
    .cart h2 {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .cart-toggle {
      position: fixed;
      right: 0;
      top: 7%;
      transform: translateY(-50%);
      background: #4A90E2;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px 0 0 5px;
      font-size: 16px;
    }
    .cart-toggle:hover {
      background: #357ABD;
    }
    .cart-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }
    .cart-item img {
      width: 40px;
      height: 40px;
      border-radius: 4px;
      margin-right: 10px;
    }
    .quantity-controls {
      display: flex;
      align-items: center;
    }
    .quantity-controls button {
      background: #28a745; border: none; color: #fff; padding: 5px 8px;
      border-radius: 4px; cursor: pointer; margin: 0 4px;
    }
    .remove-btn {
      background: #e74c3c; border: none; color: #fff; padding: 5px 8px;
      border-radius: 4px; cursor: pointer;
    }
    .checkout-button {
      background: #697184;
      color: #fff;
      font-size: 16px;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .checkout-button:hover {
      background: #5a6274;
    }
    .button-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <!-- Keep your existing nav or other UI here -->
  <!-- e.g. <nav>Bookstore | Fantasy | Sci-Fi | ...</nav> -->

  <!-- Cart Toggle Button -->
  <button class="cart-toggle" onclick="toggleCart()">🛒</button>

  <div class="container">
    <!-- Product Grid -->
    <div class="book-list" id="bookList"></div>

    <!-- Cart Sidebar -->
    <div class="cart" id="cart">
      <h2>
        Cart
        <span onclick="toggleCart()" style="cursor:pointer;">❌</span>
      </h2>
      <div id="cartItems"></div>
      <h3>Total: Rs. <span id="totalAmount">0</span></h3>
      <div class="button-container">
        <button class="checkout-button" onclick="checkout()">Checkout</button>
      </div>
    </div>
  </div>

  <script>
    const currentCategory = "bookstore";
    // Add a 'description' field to each book
    const defaultBooks = [
      {
        id: 101,
        title: "Bookstore Book 1",
        price: 500,
        image: "books/book1.jpg",
        category: "bookstore",
        stock: 10,
        description: "An excellent introduction to networking principles."
      },
      {
        id: 102,
        title: "Bookstore Book 2",
        price: 600,
        image: "books/book2.jpg",
        category: "bookstore",
        stock: 8,
        description: "A comprehensive guide on operating systems."
      }
      // Add more books if needed...
    ];

    function getInventory() {
      let inv = JSON.parse(localStorage.getItem("inventory"));
      if (!inv) {
        inv = {};
        defaultBooks.forEach(book => {
          inv[book.id] = book.stock !== undefined ? book.stock : 10;
        });
        localStorage.setItem("inventory", JSON.stringify(inv));
      }
      return inv;
    }
    function saveInventory(inv) {
      localStorage.setItem("inventory", JSON.stringify(inv));
    }
    function getAdminBooks() {
      return JSON.parse(localStorage.getItem("adminBooks")) || [];
    }
    function getRemovedBooks() {
      return JSON.parse(localStorage.getItem("removedBooks")) || [];
    }
    function getBooks() {
      const adminBooks = getAdminBooks();
      const removed = getRemovedBooks();
      const allBooks = defaultBooks.concat(adminBooks);
      const filtered = allBooks.filter(book =>
        book.category.toLowerCase() === currentCategory &&
        !removed.includes(book.id)
      );
      const inv = getInventory();
      filtered.forEach(book => {
        if (inv[book.id] !== undefined) {
          book.stock = inv[book.id];
        }
      });
      return filtered;
    }
    function getCart() {
      return JSON.parse(localStorage.getItem("cart")) || [];
    }
    function saveCart(cart) {
      localStorage.setItem("cart", JSON.stringify(cart));
    }

    function addToCart(bookId) {
      const inv = getInventory();
      const available = inv[bookId] || 0;
      const qty = parseInt(document.getElementById(`qty-${bookId}`).value) || 1;
      if (qty > available) {
        alert("Not enough stock available! Only " + available + " left.");
        return;
      }
      const cart = getCart();
      const book = getBooks().find(b => b.id === bookId);
      if (!book) return;
      const index = cart.findIndex(item => item.id === bookId);
      if (index !== -1) {
        if (cart[index].quantity + qty > available) {
          alert("Not enough stock available!");
          return;
        }
        cart[index].quantity += qty;
      } else {
        cart.push({
          id: book.id,
          title: book.title,
          price: book.price,
          quantity: qty,
          image: book.image
        });
      }
      saveCart(cart);
      updateCart();
    }

    function updateCart() {
      const cart = getCart();
      document.getElementById("cartItems").innerHTML = cart.map(item => `
        <div class="cart-item">
          <img src="${item.image}" alt="${item.title}">
          <span>${item.title} x ${item.quantity} = Rs. ${item.price * item.quantity}</span>
          <div class="quantity-controls">
            <button onclick="decreaseQty(${item.id})">-</button>
            <span>${item.quantity}</span>
            <button onclick="increaseQty(${item.id})">+</button>
          </div>
          <button class="remove-btn" onclick="removeFromCart(${item.id})">❌</button>
        </div>
      `).join('');
      const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
      document.getElementById("totalAmount").textContent = total;
    }

    function increaseQty(id) {
      const inv = getInventory();
      const available = inv[id] || 0;
      const cart = getCart();
      const item = cart.find(i => i.id === id);
      if (item) {
        if (item.quantity + 1 > available) {
          alert("Cannot increase quantity. Only " + available + " available.");
          return;
        }
        item.quantity++;
        saveCart(cart);
        updateCart();
      }
    }

    function decreaseQty(id) {
      const cart = getCart();
      const item = cart.find(i => i.id === id);
      if (item) {
        if (item.quantity > 1) {
          item.quantity--;
        } else {
          removeFromCart(id);
        }
        saveCart(cart);
        updateCart();
      }
    }

    function removeFromCart(id) {
      const cart = getCart().filter(i => i.id !== id);
      saveCart(cart);
      updateCart();
    }

    function toggleCart() {
      document.getElementById("cart").classList.toggle("open");
    }

    function checkout() {
      const cart = getCart();
      if (!cart.length) {
        alert("Your cart is empty!");
        return;
      }
      localStorage.setItem("checkoutCart", JSON.stringify(cart));
      window.location.href = "checkout.php";
    }

    function displayBooks() {
      const books = getBooks();
      document.getElementById("bookList").innerHTML = books.map(book => `
        <div class="book-card">
          <!-- FLIP CONTAINER FOR THE IMAGE + DESCRIPTION -->
          <div class="flip-container">
            <div class="flip-card">
              <!-- FRONT side (the image) -->
              <div class="flip-front">
                <img src="${book.image}" alt="${book.title}">
              </div>
              <!-- BACK side (the description) -->
              <div class="flip-back">
                <h3>${book.title}</h3>
                <p style="font-size:14px; color:#666; margin:0 5px;">
                  ${book.description || "No description available."}
                </p>
              </div>
            </div>
          </div>
          <!-- Title, Price, Stock, etc. outside the flipping image -->
          <p>Rs. ${book.price}</p>
          <p class="stock-info">
            ${book.stock > 0 ? "Only " + book.stock + " left" : "<span class='out-of-stock'>Out of Stock</span>"}
          </p>
          <input type="number" min="1" value="1" id="qty-${book.id}">
          <button class="add-to-cart" onclick="addToCart(${book.id})">Add to Cart</button>
        </div>
      `).join('');
    }

    displayBooks();
    updateCart();
  </script>
</body>
</html>
