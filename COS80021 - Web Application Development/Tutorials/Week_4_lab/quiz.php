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

// Fetch questions and their corresponding answers from the database
$sql = "SELECT q.id as question_id, q.question_text, a.id as answer_id, a.answer_text 
        FROM questions q 
        JOIN answers a ON q.id = a.question_id
        ORDER BY q.id, a.id";
$result = $conn->query($sql);

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[$row['question_id']]['question_text'] = $row['question_text'];
        $questions[$row['question_id']]['answers'][] = [
            'answer_id' => $row['answer_id'],
            'answer_text' => $row['answer_text']
        ];
    }
} else {
    echo "No questions found.";
}
?>

<!-- HTML form to display the quiz questions -->
<form action="quizsubmit.php" method="post">
    <?php foreach ($questions as $question_id => $question): ?>
        <p><?php echo $question['question_text']; ?></p>
        <?php foreach ($question['answers'] as $answer): ?>
            <input type="radio" name="question_<?php echo $question_id; ?>" value="<?php echo $answer['answer_id']; ?>">
            <?php echo $answer['answer_text']; ?><br>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <input type="submit" value="Submit Quiz">
</form>

<?php
$conn->close();
?>
