<?php
session_start();
// Use the logged-in user's name; default to "user" if not logged in
$username = isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : "user";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.cdnfonts.com/css/tt-phobos-trial" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'TT Phobos Trial', sans-serif;
            background-color: black;
            color: white;
            overflow: hidden;
        }
        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: brightness(0.6);
        }
        .container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        h1 {
            font-size: 3rem;
            margin: 0;
            opacity: 0; /* hidden initially */
            transition: opacity 0.5s ease-in-out;
        }
        h2 {
            font-size: 35px;
            font-weight: bold;
            text-shadow: 2px 2px 5px black;
            margin-top: 20px;
        }
        .word {
            opacity: 0;
            display: inline-block;
            transform: translateY(10px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }
        .arrow-up {
            position: absolute;
            right: 162px;
            top: 5px;
            font-size: 40px;
            color: white;
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards 10.5s, bounce 1.5s infinite ease-in-out 10.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="arrow-up">⬆</div>
    <video class="background-video" autoplay muted>
        <source src="videoplayback.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h1 id="welcome">Welcome, <?php echo $username; ?>!</h1>
        <h2 id="dynamic-h2"></h2>
    </div>
    <script>
        // Show the welcome message after 6 seconds
        setTimeout(() => {
            document.getElementById("welcome").style.opacity = "1";
        }, 5600);

        const text = [
            "Tired of having to", 
            "go to different",
            "bookstores for all",
            "your different book",
            "needs?"
        ];
        const h2Element = document.getElementById("dynamic-h2");
        setTimeout(() => {
            text.forEach((line, index) => {
                let lineSpan = document.createElement("span");
                lineSpan.classList.add("word");
                lineSpan.innerHTML = line;
                setTimeout(() => {
                    lineSpan.style.opacity = "1";
                    lineSpan.style.transform = "translateY(0)";
                }, index * 1000);
                h2Element.appendChild(lineSpan);
                h2Element.appendChild(document.createElement("br"));
            });
        }, 6000);
    </script>
</body>
</html>
