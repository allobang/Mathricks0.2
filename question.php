<?php
session_start();
require_once('connection.php');

// Load the JSON data
$json = file_get_contents('questions.json');
$data = json_decode($json, true);

// Get the selected grade and difficulty from the POST request or Session
$selected_grade = $_POST['grade'] ?? $_SESSION['grade'];
$selected_difficulty = $_POST['difficulty'] ?? $_SESSION['difficulty'];

$_SESSION['grade'] = $selected_grade;
$_SESSION['difficulty'] = $selected_difficulty;

// Find the questions based on selected grade and difficulty
foreach ($data['grades'] as $grade) {
    if ($grade['grade'] == $selected_grade) {
        foreach ($grade['questions'] as $questions) {
            if ($questions['difficulty'] == $selected_difficulty) {
                $items = $questions['items'];
                break 2;
            }
        }
    }
}

// Check answer and move to the next question
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_index = $_SESSION['question_index'];

    // Check if the 'answer' key is set in the POST data
    $answer = isset($_POST['answer']) ? $_POST['answer'] : null;

    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }

    // Check if an answer was submitted
    if ($answer !== null) {
        if ($answer == $items[$question_index]['answer']) {
            // echo "Correct!";
            $_SESSION['score']++; // Increment score
        } else {
            // echo "Incorrect!";
        }
    }

    $_SESSION['question_index']++; // Move to the next question

    if ($_SESSION['question_index'] >= count($items)) {
        // Save the score in the database
        $score = $_SESSION['score'];
        $grade = $_SESSION['grade'];
        $difficulty = $_SESSION['difficulty'];
    
        // Assuming $conn is your database connection
        $sql = "INSERT INTO scores (user_id, grade, difficulty, score) VALUES ('{$_SESSION['user_id']}', '$grade', '$difficulty', '$score')";
        if (mysqli_query($conn, $sql)) {
            echo "<div style='font-family: Arial, sans-serif; border: 1px solid #8bc34a; padding: 30px; border-radius: 20px; text-align: center; max-width: 400px; margin: 20px auto; background-color: #e0f7fa;'>";
    
            echo "<h2 style='color: #4caf50;'>Quiz completed!</h2>";
            echo "<p style='font-size: 20px; margin-top: 20px; color: #f57c00;'>Your score: {$score}</p>"; // Display the score
            echo "<h3 style='color: #4caf50; margin-top: 20px;'>Score saved successfully!</h3>";
            echo "<p><a href='dashboard.php' style='font-size: 20px; color: #1976d2; text-decoration: none; border: 1px solid #1976d2; padding: 12px 25px; border-radius: 30px; transition: background-color 0.3s ease;'>Dashboard</a></p>";
    
            echo "</div>";
        } else {
            echo "Error: Could not save the score.";
        }
   
    
        // Unset the specific session variables related to the quiz
        unset($_SESSION['score']);
        unset($_SESSION['question_index']);
        unset($_SESSION['grade']);
        unset($_SESSION['difficulty']);
        // ... (any other quiz-related session variables)
    
        exit;
    } else {
        header("Location: question.php"); // Load the next question
        exit;
    }
}

if (!isset($_SESSION['question_index'])) {
    $_SESSION['question_index'] = 0;
}

// Get the current question
$question = $items[$_SESSION['question_index']];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .question-container {
            background-color: #fff3e0;
            padding: 50px;
            border-radius: 30px;
            text-align: center;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            max-width: 650px;
            width: 100%;
            position: relative;
        }

        .section {
            background-color: #f5f5f5;
            padding: 20px;
            margin: 15px 0;
            border-radius: 20px;
        }

        .label-header {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }

        p {
            font-size: 24px;
            color: #f57c00;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .choice {
            margin: 15px 0;
        }

        label {
            font-size: 20px;
            color: #4caf50;
            margin-left: 10px;
            cursor: pointer;
        }

        input[type="radio"] {
            transform: scale(1.5);
            cursor: pointer;
        }

        button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 22px;
            color: #ffffff;
            background-color: #8bc34a;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            margin-top: 30px;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #689f38;
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        a {
            display: block;
            text-decoration: none;
            font-size: 18px;
            color: #1976d2;
            margin-top: 25px;
            transition: color 0.3s ease;
        }

        a:hover {
            text-decoration: underline;
            color: #0d47a1;
        }
    </style>
</head>

<body>
    <div class="question-container">
        <form action="question.php" method="POST">
            <div class="section">
                <span class="label-header">Question</span>
                <p>
                    <?php
                    // Your PHP code here
                    echo $question['question'];
                    ?>
                </p>
            </div>
            <div class="section">
                <span class="label-header">Choices</span>
                <?php foreach ($question['choices'] as $choice): ?>
                    <div class="choice">
                        <input type="radio" id="<?php echo $choice; ?>" name="answer" value="<?php echo $choice; ?>">
                        <label for="<?php echo $choice; ?>">
                            <?php echo $choice; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit">Next</button>
        </form>
        <a href="dashboard.php">Dashboard</a>
    </div>
</body>

</html>

