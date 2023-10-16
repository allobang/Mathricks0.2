<!-- dashboard.php -->
<?php
// Start the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background-color: #ffebcd;
            padding: 40px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #ff4500;
        }

        p {
            font-size: 20px;
            color: #4b0082;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            padding: 15px 25px;
            font-size: 22px;
            margin: 10px;
            color: #ffffff;
            background-color: #20b2aa;
            border-radius: 50px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2e8b57;
        }
        #math-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>

<body>
<canvas id="math-particles"></canvas> <!-- Canvas element for math particles -->

    <div class="container">
        <h1>Welcome,
            <?php 

            // Check if the user is logged in, if not then redirect to login page
            if (!isset($_SESSION["username"])) {
                header("Location: index.php");
                exit;
            }

            echo $_SESSION["username"]; ?>!
        </h1>
        <p>Ready, Set, Math-Go!</p>
        <a href="difficulty.php">Play Game</a>
        <a href="logout.php">Logout</a>
    </div>
    <script>
        const canvas = document.getElementById('math-particles');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        const particlesArray = [];

        const mathSymbols = ["+", "-", "×", "÷", "=", "π"]; // You can add more symbols or numbers here

        class Particle {
            constructor(x, y, size, symbol, speed) {
                this.x = x;
                this.y = y;
                this.size = size;
                this.symbol = symbol;
                this.speed = speed;
            }
            
            draw() {
                ctx.font = `${this.size}px Arial`;
                ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
                ctx.fillText(this.symbol, this.x, this.y);
            }
            
            update() {
                this.y += this.speed;
                if (this.y > canvas.height) {
                    this.y = 0 - this.size;
                    this.x = Math.random() * canvas.width;
                }
            }
        }

        function init() {
            for (let i = 0; i < 50; i++) {
                const x = Math.random() * canvas.width;
                const y = Math.random() * canvas.height;
                const size = Math.random() * 20 + 20;
                const symbol = mathSymbols[Math.floor(Math.random() * mathSymbols.length)];
                const speed = Math.random() * 3 + 1;
                particlesArray.push(new Particle(x, y, size, symbol, speed));
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
                particlesArray[i].draw();
            }
            requestAnimationFrame(animate);
        }

        init();
        animate();
    </script>
</body>

</html>
