<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz</title>
</head>
<body>
    <form method="post" action="quiz.php">
        <h3>1. How many cricket ODI World Cups does Australia have?</h3>
        6 <input type="radio" name="q1" value="6">&nbsp;&nbsp;&nbsp;
        5 <input type="radio" name="q1" value="5">&nbsp;&nbsp;&nbsp;
        3 <input type="radio" name="q1" value="3">&nbsp;&nbsp;&nbsp;
        1 <input type="radio" name="q1" value="1">&nbsp;&nbsp;&nbsp;
        <br>

        <h3>2. What is the national animal of Australia?</h3>
        Elephant <input type="radio" name="q2" value="elephant">&nbsp;&nbsp;&nbsp;
        Hippo <input type="radio" name="q2" value="hippo">&nbsp;&nbsp;&nbsp;
        Tiger <input type="radio" name="q2" value="tiger">&nbsp;&nbsp;&nbsp;
        Kangaroo <input type="radio" name="q2" value="kangaroo">&nbsp;&nbsp;&nbsp;
        <br>

        <h3>3. What is the population of Australia?</h3>
        10 million <input type="radio" name="q3" value="10 million">&nbsp;&nbsp;&nbsp;
        25 million <input type="radio" name="q3" value="25 million">&nbsp;&nbsp;&nbsp;
        30 million <input type="radio" name="q3" value="30 million">&nbsp;&nbsp;&nbsp;
        6 million <input type="radio" name="q3" value="6 million">&nbsp;&nbsp;&nbsp;
        <br>

        <h3>4. Who is the current prime minister of Australia?</h3>
        Mr. Anthony Albanese <input type="radio" name="q4" value="albanese">&nbsp;&nbsp;&nbsp;
        Mr. Tony Abbott <input type="radio" name="q4" value="abbott">&nbsp;&nbsp;&nbsp;
        Mr. Peter Jackson <input type="radio" name="q4" value="jackson">&nbsp;&nbsp;&nbsp;
        Mr. Ricky Ponting <input type="radio" name="q4" value="ponting">&nbsp;&nbsp;&nbsp;
        <br>

        <h3>5. Who is the captain of the Australian cricket team?</h3>
        Mr. Pat Cummins <input type="radio" name="q5" value="cummins">&nbsp;&nbsp;&nbsp;
        Mr. Aaron Finch <input type="radio" name="q5" value="finch">&nbsp;&nbsp;&nbsp;
        Mr. Steve Smith <input type="radio" name="q5" value="smith">&nbsp;&nbsp;&nbsp;
        Mr. David Warner <input type="radio" name="q5" value="warner">&nbsp;&nbsp;&nbsp;
        <br>

        <input type="submit" value="Submit" />
    </form>
</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD']=='POST'){
    $correct_answers = [
        "q1" => "5",
        "q2" => "kangaroo",
        "q3" => "25 million",
        "q4" => "albanese",
        "q5" => "cummins"
    ];


    $score = 0;
    foreach($correct_answers as $question => $answer){

        if(isset($_POST[$question]) && ($_POST[$question])==$answer){

            $score++;
            echo '<p> '.$question. ' - '.$correct_answers[$question].' '. '(correct)</p>';
        }

        else{
            echo '<p> '.$question .' - '.$correct_answers[$question].' '. '(incorrect)</p>';
        }
    }

    echo '<h3>Your final score is : ' .$score.' / 5 </h3>';
}
else{
    echo '<h3>Please submit the quiz to get a score</h3>';
}


?>