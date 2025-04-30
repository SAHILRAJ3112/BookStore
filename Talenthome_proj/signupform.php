<?php 
    session_start();
?>

<html>
    <head>
        <title>Sign Up</title>
        <style>
            body {
                font-family: 'Avenir', sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }
            h1 {
                color: #333;
            }
            form {
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                padding: 30px;
                max-width: 400px;
                width: 100%;
                text-align: left;
            }
            input[type=text], input[type=email], input[type=password] {
                width: calc(100% - 22px);
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            input[type=submit], input[type=reset] {
                background-color: #5cb85c;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 10px 5px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            input[type=submit]:hover, input[type=reset]:hover {
                background-color: #489a48;
            }
            #message {
                margin: 5px 0;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <h1>Sign-up Form:</h1>
        <form name="signupform" action="http://localhost/Talenthome_proj/signup.php" method="get">
            <label for="fname">Name:</label> 
            <input type="text" name="fname" id="fname"><br>
            <label for="email">E-mail:</label> 
            <input type="email" name="email" id="email"><br>
            <label for="pass1">Enter Password:</label> 
            <input type="password" name="pass" id="pass1"><br>
            <label for="pass2">Confirm Password:</label> 
            <input type="password" name="cpass" id="pass2" onkeyup="checkpass()"><span id="message"></span><br>
            <input type="submit"><input type="reset">
        </form>

        <script type="text/javascript">
            function checkpass(){
                if(document.getElementById('pass1').value == document.getElementById('pass2').value){
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = "Matching";
                } else{
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = "Not matching";
                }
            }
        </script>
    </body>
</html>
