<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us</title>
  <style>
    /* Global Styles */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    /* Contact Card Styles */
    .contact-card {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
      animation: fadeIn 0.8s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .contact-card h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .contact-card form {
      display: flex;
      flex-direction: column;
    }
    .contact-card input,
    .contact-card textarea {
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      transition: border-color 0.3s;
    }
    .contact-card input:focus,
    .contact-card textarea:focus {
      outline: none;
      border-color: #4A90E2;
    }
    .contact-card button {
      padding: 12px;
      background: linear-gradient(135deg, #4A90E2, #357ABD);
      border: none;
      color: #fff;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .contact-card button:hover {
      background: linear-gradient(135deg, #357ABD, #2A4B73);
    }
  </style>
</head>
<body>
  <div class="contact-card">
    <h2>Contact Us</h2>
    <form action="submit_contact.php" method="POST">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </div>
</body>
</html>
