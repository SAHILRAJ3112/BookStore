<?php 
session_start();
?>
<html>
    <head>
        <title>Store Page</title>
        <style>
            #navbar{
                background-color: #007FFF;
                width: 100%;
                height: 35px;
                padding-top: 10px;
                padding-left: 3px;
            }
            a{
                text-decoration: none;
                padding: 30px;
                font-size: large;
                color: white;
            }
            .maindiv{
                display: block;
                width: 100%;
                height: 100%;
            }
            iframe{
            width: 100%;
            height: 100%;
            border: none;
        }
        </style>
    </head>
    <body>
        <div id="navbar">
            <nav>
                <a href="http://localhost/Talenthome_proj/bbacasem3.php" target="main">Education</a>
                <a href="http://localhost/Talenthome_proj/witcher.php" target="main">Fantasy</a>
                <a href="http://localhost/Talenthome_proj/horror.php" target="main">Horror</a>
                <a href="http://localhost/Talenthome_proj/romance.php" target="main">Romance</a>
                <a href="http://localhost/Talenthome_proj/nonfict.php" target="main">Non-Fiction</a>
            </nav>
        </div>
        <div class="maindiv">
            <iframe name="main" src="bbacasem3.php"></iframe>
        </div>
    </body>
</html>