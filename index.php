<?php
require_once('connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtain username and password from POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Redirect to a secure page
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8d7da;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #495057;
        }

        label {
            font-size: 18px;
            color: #495057;
        }

        input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: calc(100% - 22px);
            margin-bottom: 20px; 
        }

        button {
            padding: 10px 20px;
            background-color: #38c172;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2d995b;
        }

        a {
            text-decoration: none;
            color: #3490dc;
            font-size: 16px;
            margin-left: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
        #particles {
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
    <canvas id="particles"></canvas> <!-- Canvas element for particles -->

    <div class="container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label><br>
            <input type="text" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br>
            <button type="submit">Login</button><a href="register.php">Register</a>
        </form>
    </div>
    <script>
        const canvas = document.getElementById('particles');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        const particlesArray = [];

        class Particle {
            constructor(x, y, size, weight) {
                this.x = x;
                this.y = y;
                this.size = size;
                this.weight = weight;
            }
            
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
                ctx.closePath();
                ctx.fill();
            }
            
            update() {
                this.size -= 0.05;
                if (this.size < 0) {
                    this.x = (Math.random() * canvas.width);
                    this.y = (Math.random() * canvas.height);
                    this.size = (Math.random() * 15) + 10;
                    this.weight = (Math.random() * 2) - 0.5;
                }
                this.y += this.weight;
                this.weight += 0.2;
                
                if (this.y > canvas.height) {
                    this.y = 0 - this.size;
                    this.weight = (Math.random() * 2) - 0.5;
                }
            }
        }

        function init() {
            for (let i = 0; i < 50; i++) {
                const x = Math.random() * canvas.width;
                const y = Math.random() * canvas.height;
                const size = (Math.random() * 15) + 10;
                const weight = (Math.random() * 2) - 0.5;
                particlesArray.push(new Particle(x, y, size, weight));
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
