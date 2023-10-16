<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Grade and Difficulty</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fce4ec;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        form {
            background-color: #f8bbd0;
            padding: 40px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            font-size: 20px;
            color: #c2185b;
            display: block;
            margin-bottom: 10px;
        }

        select {
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 80%;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 22px;
            color: #ffffff;
            background-color: #ec407a;
            border: none;
            border-radius: 50px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d81b60;
        }

        a {
            display: block;
            text-decoration: none;
            font-size: 18px;
            color: #ab47bc;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
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

<body> <canvas id="math-particles"></canvas> <!-- Canvas element for math particles -->

    <form action="question.php" method="POST">
        <label for="grade">Select Grade:</label>
        <select name="grade" id="grade">
            <option value="2">Grade 2</option>
            <!-- Add more grades as needed -->
        </select>

        <label for="difficulty">Select Difficulty:</label>
        <select name="difficulty" id="difficulty">
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
        </select>

        <button type="submit">Start</button>
        <a href="dashboard.php">Dashboard</a>
    </form>
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