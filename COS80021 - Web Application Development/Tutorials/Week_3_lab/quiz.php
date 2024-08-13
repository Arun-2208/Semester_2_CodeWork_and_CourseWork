<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
</head>
<body>
    <h1>Quiz Results</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $score = 0;
        $answersList=file('answers.txt');

        for($j=0;$j<count($answersList);$j++){
            
            $key = 'question'.($j+1);
            if(strcmp(trim($answersList[$j]),trim($_POST[$key]))==0){

                $score+=1;

                echo '<p>Correct answer - '.$answersList[$j].' <br> User answer - '.$_POST[$key].'  <br><strong>CORRECT</strong></p>';
            }else{

                echo '<p>Correct answer - '.$answersList[$j].' <br> User answer - '.$_POST[$key].' <br><strong>IN-CORRECT</strong></p>';
            }

        }

        echo '<p>Your score : <strong>'.$score.'/5</strong></p>';
    }
    ?>
</body>
</html>