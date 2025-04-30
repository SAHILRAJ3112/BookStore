<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - Manage Books & Inventory</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
  <style>
    /* Global Styles */
    * { box-sizing: border-box; }
    body {
      font-family: 'Roboto', sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 20px;
    }
    h1 { text-align: center; margin-bottom: 20px; }

    /* Container for Admin Panel */
    .admin-container {
      display: flex;
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Left Pane: Active Books Area */
    .left-pane {
      flex: 1;
      background: #fff;
      border-radius: 8px;
      padding: 15px;
      max-height: 80vh;
      overflow-y: auto;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .left-pane h2 { text-align: center; margin-bottom: 15px; }
    .active-books {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 15px;
    }
    .admin-book-card {
      background: #fafafa;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .admin-book-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .admin-book-card img {
      width: 100%;
      height: 130px;
      object-fit: cover;
      border-radius: 4px;
      margin-bottom: 8px;
    }
    .admin-book-card h3 {
      font-size: 16px;
      margin: 5px 0;
      color: #333;
    }
    .admin-book-card .desc {
      font-size: 13px;
      color: #666;
      margin-bottom: 8px;
      height: 36px;
      overflow: hidden;
    }
    .admin-book-card p {
      font-size: 14px;
      font-weight: bold;
      margin: 5px 0;
      color: #555;
    }
    .stock-info {
      font-size: 13px;
      margin-bottom: 8px;
    }
    .out-of-stock { color: red; font-weight: bold; }
    .update-stock {
      display: flex;
      align-items: center;
      gap: 5px;
      margin-bottom: 8px;
    }
    .update-stock input {
      width: 50px;
      padding: 4px;
      font-size: 13px;
    }
    .update-stock button {
      padding: 4px 8px;
      font-size: 12px;
      background: #4A90E2;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .update-stock button:hover { background: #357ABD; }
    .admin-book-card button.remove-btn {
      background: #e74c3c;
      border: none;
      color: #fff;
      padding: 5px 8px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 13px;
      width: 100%;
      margin-top: 5px;
    }
    .admin-book-card button.remove-btn:hover { background: #c0392b; }

    /* Right Pane: Category Selector & Add Book Form */
    .right-pane {
      width: 400px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    #categorySelector, #addBookForm {
      background: #fff;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      text-align: center;
    }
    #categorySelector select {
      width: 80%;
      padding: 10px;
      font-size: 16px;
    }
    #categorySelector button, #changeCategoryBtn button {
      margin-top: 10px;
      padding: 10px 15px;
      background: linear-gradient(135deg, #4A90E2, #357ABD);
      border: none;
      color: #fff;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    #categorySelector button:hover, #changeCategoryBtn button:hover {
      background: linear-gradient(135deg, #357ABD, #2C659E);
    }
    #changeCategoryBtn { display: none; }
    #addBookForm label { display: block; margin: 10px 0 5px; font-weight: 500; }
    #addBookForm input[type="text"],
    #addBookForm input[type="number"],
    #addBookForm input[type="file"],
    #addBookForm input[readonly],
    #addBookForm textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    #addBookForm button {
      margin-top: 15px;
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #4A90E2, #357ABD);
      border: none;
      color: #fff;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    #addBookForm button:hover {
      background: linear-gradient(135deg, #357ABD, #2C659E);
    }
    .message { text-align: center; margin-top: 10px; color: green; font-weight: 500; }

    /* Cart Sidebar & Other Elements remain unchanged */
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
    .cart.open { right: 0; }
    .cart h2 { display: flex; justify-content: space-between; align-items: center; }
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
      z-index: 999;
    }
    .cart-toggle:hover { background: #357ABD; }
    .cart-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }
    .cart-item img { width: 40px; height: 40px; border-radius: 4px; margin-right: 10px; }
    .quantity-controls { display: flex; align-items: center; }
    .quantity-controls button {
      background: #28a745; border: none; color: #fff; padding: 5px 8px;
      border-radius: 4px; cursor: pointer; margin: 0 4px;
    }
    .remove-btn {
      background: #e74c3c; border: none; color: #fff; padding: 5px 8px;
      border-radius: 4px; cursor: pointer;
    }
    .checkout-button {
      background: #697184; color: #fff; font-size: 16px;
      padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer;
      transition: background 0.3s;
    }
    .checkout-button:hover { background: #5a6274; }
    .button-container { display: flex; justify-content: center; margin-top: 20px; }

    /* Modern Orders Section for Checkout Details */
    .orders-section {
      background: #fff;
      padding: 20px;
      margin: 30px auto;
      max-width: 1200px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .orders-section h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .order-card {
      background: #f9f9f9;
      border-radius: 8px;
      padding: 15px 20px;
      margin-bottom: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      position: relative;
      transition: transform 0.2s;
    }
    .order-card:hover {
      transform: translateY(-3px);
    }
    .order-card h3 {
      margin-top: 0;
      color: #4A90E2;
    }
    .order-details {
      font-size: 14px;
      color: #555;
      margin: 5px 0;
    }
    .order-items ul {
      padding-left: 20px;
      margin: 5px 0;
    }
    .order-items li {
      list-style-type: disc;
      margin: 3px 0;
    }
    .remove-order-btn {
      position: absolute;
      top: 15px;
      right: 20px;
      background: #e74c3c;
      color: #fff;
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 12px;
      transition: background 0.3s;
    }
    .remove-order-btn:hover {
      background: #c0392b;
    }
  </style>
</head>
<body>
  <h1>Admin Panel - Manage Books & Inventory</h1>
  <div class="admin-container">
    <!-- Left Pane: Active Books Area -->
    <div class="left-pane" id="bookList">
      <h2>Active Books in <span id="currentCatLabel"></span></h2>
      <div class="active-books" id="activeBooks"></div>
    </div>
    <!-- Right Pane: Category Selector & Add Book Form -->
    <div class="right-pane">
      <div id="categorySelector">
        <label for="adminCategorySelect"><strong>Select Category to Manage:</strong></label>
        <select id="adminCategorySelect" required>
          <option value="">-- Choose Category --</option>
          <option value="bookstore">Bookstore</option>
          <option value="horror">Horror</option>
          <option value="fantasy">Fantasy</option>
          <option value="scifi">Sci-Fi</option>
          <option value="romance">Romance</option>
          <option value="suggestion">Suggestion</option>
        </select>
        <br>
        <button onclick="setAdminCategory()">Manage Category</button>
      </div>
      <div id="changeCategoryBtn">
        <button onclick="changeCategory()">Change Category</button>
      </div>
      <form id="addBookForm">
        <label for="title">Title:</label>
        <input type="text" id="title" placeholder="Enter book title" required>

        <label for="price">Price (Rs.):</label>
        <input type="number" id="price" placeholder="Enter price" required>
        
        <label for="stock">Initial Quantity:</label>
        <input type="number" id="stock" placeholder="Enter initial stock" required>
        
        <label for="description">Description:</label>
        <textarea id="description" placeholder="Enter book description" required></textarea>

        <label for="category">Category:</label>
        <input type="text" id="category" readonly required>

        <label for="image">Image:</label>
        <input type="file" id="image" accept="image/*" required>

        <button type="submit">Add Book</button>
        <div class="message" id="message"></div>
      </form>
    </div>
  </div>
  
  <!-- New Orders Section to Display Checkout Details -->
  <div class="orders-section">
    <h2>Checkout Details</h2>
    <div id="ordersList"></div>
  </div>

  <script>
    let currentAdminCategory = "";

    // Default books with description included.
    const defaultBooks = [
      { id: 1, title: "Networking - SY BBA CA", price: 500, image: "books/book1.jpg", category: "bookstore", stock: 10, description: "An excellent introduction to networking principles." },
      { id: 2, title: "Operating System - SY BBA CA", price: 600, image: "books/book2.jpg", category: "bookstore", stock: 8, description: "A comprehensive guide on operating systems." },
      { id: 3, title: "Horror Book 1", price: 700, image: "books/horror1.jpg", category: "horror", stock: 5, description: "A spine-chilling horror tale." },
      { id: 4, title: "Fantasy Book 1", price: 650, image: "books/fantasy1.jpg", category: "fantasy", stock: 12, description: "A magical journey in a fantastical world." },
      { id: 5, title: "Sci-Fi Book 1", price: 800, image: "books/scifi1.jpg", category: "scifi", stock: 7, description: "A futuristic adventure beyond the stars." },
      { id: 6, title: "Romance Book 1", price: 550, image: "books/romance1.jpg", category: "romance", stock: 9, description: "A heartwarming romance story." },
      { id: 7, title: "Suggestion Book 1", price: 500, image: "books/suggestion1.jpg", category: "suggestion", stock: 15, description: "Customer suggestions and insights." }
    ];

    function getAdminBooks() { return JSON.parse(localStorage.getItem("adminBooks")) || []; }
    function saveAdminBooks(books) { localStorage.setItem("adminBooks", JSON.stringify(books)); }
    function getRemovedBooks() { return JSON.parse(localStorage.getItem("removedBooks")) || []; }
    function saveRemovedBooks(arr) { localStorage.setItem("removedBooks", JSON.stringify(arr)); }
    
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
    function saveInventory(inv) { localStorage.setItem("inventory", JSON.stringify(inv)); }
    function updateInventoryForNewBook(book) {
      let inv = getInventory();
      inv[book.id] = book.stock;
      saveInventory(inv);
    }
    
    function getAllBooks() {
      const adminBooks = getAdminBooks();
      const removed = getRemovedBooks();
      const all = defaultBooks.concat(adminBooks);
      const filtered = all.filter(book =>
        book.category.toLowerCase() === currentAdminCategory && !removed.includes(book.id)
      );
      const inv = getInventory();
      filtered.forEach(book => {
        if (inv[book.id] !== undefined) { book.stock = inv[book.id]; }
      });
      return filtered;
    }
    
    function displayBooks() {
      const books = getAllBooks();
      const container = document.getElementById("activeBooks");
      container.innerHTML = books.map(book => `
        <div class="admin-book-card">
          <img src="${book.image}" alt="${book.title}">
          <h3>${book.title}</h3>
          <p class="desc">${book.description}</p>
          <p>Rs. ${book.price}</p>
          <p class="stock-info">
            ${book.stock > 0 ? "Stock: " + book.stock : "<span class='out-of-stock'>Out of Stock</span>"}
          </p>
          <div class="update-stock">
            <input type="number" id="update-${book.id}" value="${book.stock}" min="0">
            <button onclick="updateStock(${book.id})">Update</button>
          </div>
          <button class="remove-btn" onclick="removeBook(${book.id})">Remove</button>
        </div>
      `).join('');
    }
    
    function updateStock(bookId) {
      const newStock = parseInt(document.getElementById("update-" + bookId).value);
      if (isNaN(newStock) || newStock < 0) {
        alert("Please enter a valid stock quantity (>= 0).");
        return;
      }
      let inv = getInventory();
      inv[bookId] = newStock;
      saveInventory(inv);
      displayBooks();
    }
    
    function removeBook(id) {
      let adminBooks = getAdminBooks();
      const index = adminBooks.findIndex(b => b.id === id);
      if (index !== -1) {
        adminBooks.splice(index, 1);
        saveAdminBooks(adminBooks);
      } else {
        let removed = getRemovedBooks();
        if (!removed.includes(id)) {
          removed.push(id);
          saveRemovedBooks(removed);
        }
      }
      displayBooks();
    }
    
    function setAdminCategory() {
      const select = document.getElementById("adminCategorySelect");
      const cat = select.value;
      if (!cat) {
        alert("Please select a category.");
        return;
      }
      currentAdminCategory = cat.toLowerCase();
      document.getElementById("category").value = currentAdminCategory;
      document.getElementById("category").readOnly = true;
      document.getElementById("addBookForm").style.display = "block";
      document.getElementById("bookList").style.display = "block";
      document.getElementById("changeCategoryBtn").style.display = "block";
      document.getElementById("currentCatLabel").textContent = currentAdminCategory;
      displayBooks();
    }
    
    function changeCategory() {
      currentAdminCategory = "";
      document.getElementById("adminCategorySelect").value = "";
      document.getElementById("addBookForm").style.display = "none";
      document.getElementById("bookList").style.display = "none";
      document.getElementById("changeCategoryBtn").style.display = "none";
    }
    
    document.getElementById("addBookForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const title = document.getElementById("title").value;
      const price = parseFloat(document.getElementById("price").value);
      const stock = parseInt(document.getElementById("stock").value);
      const description = document.getElementById("description").value;
      const category = currentAdminCategory;
      const file = document.getElementById("image").files[0];
      if (!file) {
        alert("Please select an image file.");
        return;
      }
      const reader = new FileReader();
      reader.onload = function() {
        const imageDataUrl = reader.result;
        let adminBooks = getAdminBooks();
        const all = defaultBooks.concat(adminBooks);
        let newId = all.length ? Math.max(...all.map(b => b.id)) + 1 : 1;
        const newBook = { id: newId, title, price, category, image: imageDataUrl, stock: stock, description: description };
        adminBooks.push(newBook);
        saveAdminBooks(adminBooks);
        updateInventoryForNewBook(newBook);
        document.getElementById("addBookForm").reset();
        document.getElementById("category").value = currentAdminCategory;
        document.getElementById("message").textContent = "Book added successfully!";
        setTimeout(() => { document.getElementById("message").textContent = ""; }, 3000);
        displayBooks();
      }
      reader.readAsDataURL(file);
    });
    
    // New function to remove an order
    function removeOrder(orderId) {
      let orders = JSON.parse(localStorage.getItem("orders")) || [];
      orders = orders.filter(order => order.orderId !== orderId);
      localStorage.setItem("orders", JSON.stringify(orders));
      displayOrders();
    }
    
    // New function to display checkout details (orders)
    function displayOrders() {
      const orders = JSON.parse(localStorage.getItem("orders")) || [];
      const ordersList = document.getElementById("ordersList");
      if (orders.length === 0) {
        ordersList.innerHTML = "<p>No orders placed yet.</p>";
        return;
      }
      ordersList.innerHTML = orders.map(order => {
        return `
          <div class="order-card">
            <button class="remove-order-btn" onclick="removeOrder(${order.orderId})">Remove</button>
            <h3>Order ID: ${order.orderId}</h3>
            <p class="order-details"><strong>Name:</strong> ${order.userName}</p>
            <p class="order-details"><strong>Address:</strong> ${order.userAddress}</p>
            <p class="order-details"><strong>Phone:</strong> ${order.userPhone}</p>
            <p class="order-details"><strong>Total:</strong> Rs. ${order.total}</p>
            <p class="order-details"><strong>Ordered On:</strong> ${new Date(order.timestamp).toLocaleString()}</p>
            <div class="order-items">
              <p><strong>Items:</strong></p>
              <ul>
                ${order.cart.map(item => `<li>${item.title} x ${item.quantity} = Rs. ${item.price * item.quantity}</li>`).join('')}
              </ul>
            </div>
          </div>
        `;
      }).join('');
    }
    
    // Call displayOrders() when the admin page loads
    displayOrders();
  </script>
</body>
</html>
