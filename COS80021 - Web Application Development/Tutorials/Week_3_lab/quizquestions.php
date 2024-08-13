<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz</title>
</head>
<body>
    <form method="post" action="quiz.php">
        <?php

        $questionsList = file('questions.txt');
        $answersList = file('answers.txt',);
        $options = 4;
        $index = 1;
        for($i=0;$i<count($questionsList);$i+=$options+1){

            $questionBlock = array_slice($questionsList,$i,($options+1));
            
            echo '<p>'.$questionBlock[0].'</p>';

            
            $key = 'question'.($index);
            for($j=1;$j<=$options;$j++){

                echo $questionBlock[$j].'<input type = "radio" name = "'.$key.'" value = '.$questionBlock[$j].'><br>'; 
                

            }     
            $index++;
        }
        
        ?>
        <input type="submit" value="Submit" />
    </form>
</body>
</html>