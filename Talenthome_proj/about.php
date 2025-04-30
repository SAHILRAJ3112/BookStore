<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Bombay Book Stores</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f1ea;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 2.8em;
            font-weight: 600;
            padding: 20px 0;
            margin: 0;
            background: linear-gradient(135deg, #8e44ad, #3498db);
            color: white;
            animation: fadeInDown 1s ease;
        }
        .container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 40px;
            gap: 30px;
        }
        .left {
            flex: 1;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            animation: slideInLeft 1s ease;
        }
        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: slideInRight 1s ease;
        }
        .right img {
            width: 80%;
            max-width: 500px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            color: #555;
        }
        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #8e44ad;
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .cta-button:hover {
            background: #6c3483;
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
            }
            .right img {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>About Us</h1>
    <div class="container">
        <div class="left">
            <p>Welcome to <strong>Bombay Book Stores</strong>, where the love for books knows no bounds. We are passionate bibliophiles dedicated to igniting this passion in others.</p>
            <p>Our mission is to create a community where book lovers can celebrate reading together. Whether you're a seasoned reader or just starting, our collection will inspire you.</p>
            <p>Explore new worlds, uncover hidden gems, and let every book take you on a journey beyond imagination.</p>
            <a href="store.php" class="cta-button">Explore Our Collection</a>
        </div>
        <div class="right">
            <img src="boook.jpg" alt="Bombay Book Stores">
        </div>
    </div>
</body>
</html>
