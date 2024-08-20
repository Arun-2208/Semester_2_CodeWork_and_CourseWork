<?php
// Database connection parameters
$host = 'feenix-mariadb.swin.edu.au';
$user = 's104837257';
$pwd = '220899';
$sql_db = 's104837257_db';

$conn = new mysqli($host, $user, $pwd, $sql_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$score = 0;
$total_questions = count($_POST);

echo "<h2>Quiz Results</h2>";

foreach ($_POST as $question_key => $answer_id) {
    $question_id = str_replace('question_', '', $question_key);

    // Fetch the question text, the user's answer, and the correct answer
    $sql = "SELECT q.question_text, a.answer_text AS user_answer, a.is_correct, 
                   (SELECT answer_text FROM answers WHERE question_id = q.id AND is_correct = 1) AS correct_answer
            FROM questions q
            JOIN answers a ON q.id = a.question_id
            WHERE a.id = ? AND q.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $answer_id, $question_id);
    $stmt->execute();
    $stmt->bind_result($question_text, $user_answer, $is_correct, $correct_answer);
    $stmt->fetch();

    echo "<p><strong>Question:</strong> $question_text</p>";
    echo "<p><strong>Your Answer:</strong> $user_answer</p>";

    if ($is_correct) {
        echo "<p style='color: green;'>Correct!</p>";
        $score++;
    } else {
        echo "<p style='color: red;'>Incorrect. The correct answer is: $correct_answer</p>";
    }

    $stmt->close();
}

echo "<h3>Your Score: $score out of $total_questions</h3>";

$conn->close();
?>
