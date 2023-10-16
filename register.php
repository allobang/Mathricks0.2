<!-- register.php -->
<?php
require_once('connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtain user input from POST data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $grade = $_POST['grade'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, grade, role, username, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $firstname, $lastname, $grade, $role, $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        header('location:index.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8d7da;
            text-align: center;
        }

        h2 {
            color: #494949;
            font-size: 36px;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 40px;
            margin: auto;
            max-width: 400px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            color: #494949;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px; /* Adjusted margin */
        }

        button {
            background-color: #ff61a6;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #fc3468;
        }
    </style>
</head>

<body>
    <h2>Welcome Kiddos! 🚀</h2>
    <form action="" method="post">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" required><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" required><br>

        <label for="grade">Grade:</label>
        <input type="number" name="grade"><br>

        <label for="role">Role:</label>
        <input type="text" name="role" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Join the Adventure!</button>
    </form>
</body>

</html>
