<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f4f4f4;
            padding: 20px;
        }
        .contact-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        .success-message {
            display: none;
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
        .contact-details {
            margin-top: 30px;
            font-size: 16px;
        }
        .contact-details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you! Fill out the form below.</p>
        
        <form id="contactForm" method="POST" action="contact.php">
        <input type="text" id="name" name="name" placeholder="Your Name" required>
<input type="email" id="email" name="email" placeholder="Your Email" required>
<textarea id="message" name="message" rows="4" placeholder="Your Message" required></textarea>

    <button type="submit">Send Message</button>
</form>

        
        <p class="success-message" id="successMessage">Thank you! Your message has been sent.</p>
        
        <div class="contact-details">
            <h3>Contact Details</h3>
            <p><strong>Phone:</strong> +91 1234567891</p>
            <p><strong>Email:</strong> contact@example.com</p>
            <p><strong>Address:</strong> 123 Main Street, City, Country</p>
        </div>
    </div>

    <script>
        document.getElementById("contactForm").addEventListener("submit", function(event) {
            event.preventDefault();
            document.getElementById("successMessage").style.display = "block";
            setTimeout(() => {
                document.getElementById("successMessage").style.display = "none";
                document.getElementById("contactForm").reset();
            }, 3000);
        });
    </script>
</body>
</html>
