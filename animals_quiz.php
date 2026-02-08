<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals Quiz - The World Around Us</title>

</head>

<body>
    <?php
    // start the session to access session variables
    session_start();

    // Retrieve the player's name from the session, defaulting to 'Guest' if not set
    $name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest';
    ?>
    
    <header>
        <h1>The World Around Us - Animals Quiz</h1>
    </header>

    <?php
    // Parse the questions from the questions.txt file , file returns an array of lines from the file
    $lines = file('data-files/questions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $animalQuestions = [];
    $inAnimalSection = false;

    foreach ($lines as $line) {
        if (trim($line) === 'ANIMALS QUESTIONS') {
            $inAnimalSection = true;
            continue;
        }
        if (trim($line) === 'ENVIRONMENT QUESTIONS') {
            break;
        }

        if ($inAnimalSection && strpos($line, '|') !== false) {
            $quiz_parts = explode('|', $line);
            $animalQuestions[] = [
                'question' => trim($quiz_parts[0]),
                'answer' => trim($quiz_parts[1])
            ];
        }
    }
    ?>

    <div class="game-container">
        <p><strong>Player:</strong> <?php echo $name; ?></p>
        
        <h2>Animals Quiz</h2>
        <p>Welcome to the Animals Quiz! Answer the questions below:</p>
        
        <form action="submit_game.php" method="post">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="topic" value="animals">
            
            <?php
            // Randomly shuffle and select 4 animal questions
            shuffle($animalQuestions);
            $questionsToShow = array_slice($animalQuestions, 0, 4);
            
            foreach ($questionsToShow as $index => $q) {
                $questionNum = $index + 1;
                echo '<div class="question">';
                echo '<p><strong>Question ' . $questionNum . ':</strong> ' . htmlspecialchars($q['question']) . '</p>';
                echo '<input type="text" name="answers[]" required><br/>';
                echo '</div><br/>';
            }
            ?>
            
            <input type="submit" value="Submit Answers">
            <a href="index.php"><button type="button">Back to Home</button></a>
        </form>

        <?php $_SESSION['current_questions'] = $questionsToShow;?>
        
    </div>
</body>
</html>