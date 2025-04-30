<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Book Store</title>
        <style>
            body {
                font-family: 'Avenir', sans-serif;
                margin: 0;
                padding: 0;
            }
            a {
                text-decoration: none;
                color: #fff;
                font-size: large;
                padding: 15px;
                transition: background-color 0.3s ease;
            }
            a:hover {
                background-color: #444;
            }
            .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 50px;
                padding: 0 20px;
                background-color: #000;
            }
            .logo {
                font-size: 1.5rem;
                font-weight: bold;
                color: #ffa500;
            }
            .profile {
                display: flex;
                align-items: center;
            }
            .profile a {
                margin-right: 10px;
            }
            nav {
                display: flex;
            }
            nav a {
                margin-left: 10px;
            }
            .main {
                width: 100%;
                height: calc(100vh - 50px);
                overflow: hidden;
            }
            .main iframe {
                width: 100%;
                height: 100%;
                border: none;
                transition: transform 0.5s ease-in-out;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <div class="logo">Book Store</div>
            <div class="profile">
                <?php if ($isLoggedIn): ?>
                    <!-- If logged in, show only Logout -->
                    <a href="logout.php" onclick="window.top.location.href='logout.php'; return false;">Logout</a>


                <?php else: ?>
                    <!-- If not logged in, show Register and Login -->
                    <a href="signupform.php" target="home">Register</a>
                    <a href="loginform.php" target="home">Login</a>
                <?php endif; ?>
            </div>
            <nav>
                <a href="home.php" target="home">Home</a>
                <a href="about.php" target="home">About us</a>
                <a href="store.php" target="home">Store</a>
                <a href="contactus.php" target="home">Contact us</a>
            </nav>
        </div>
        <div class="main">
            <iframe name="home" src="home.php"></iframe>
        </div>
    </body>
</html>