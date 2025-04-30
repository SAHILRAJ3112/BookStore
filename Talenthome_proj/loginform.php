<html>
    <head>
        <title>Login</title>
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
            input[type=email], input[type=password] {
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
        </style>
    </head>
    <body>
        <h1>Login Form:</h1>
        <form name="loginform" method="get" action="http://localhost/Talenthome_proj/login.php">
            <label for="email">Enter E-mail address:</label>
            <input type="email" name="email" id="email"><br>
            <label for="pass">Enter Password:</label>
            <input type="password" name="pass" id="pass"><br>
            <input type="submit" value="Login">
            <input type="reset">
        </form>
    </body>
</html>