<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environment Quiz - The World Around Us</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <?php
    // start the session to access session variables
    session_start();

    // Retrieve the player's name from the session, defaulting to 'Guest' if not set
    $name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest';
    ?>
    
    <header>
        <h1>The World Around Us - Environment Quiz</h1>
    </header>

    <?php
    // parse the questions from the questions.txt file , file returns an array of lines from the file
    $lines = file('data-files/questions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $environmentQuestions = [];
    $inEnvironmentSection = false;

    foreach ($lines as $line) {
        if (trim($line) === 'ENVIRONMENT QUESTIONS') {
            $inEnvironmentSection = true;
            continue;
        }
        // Stop when we reach the end of file (no more sections after ENVIRONMENT)
        if ($inEnvironmentSection && strpos($line, '|') !== false) {
            $quiz_parts = explode('|', $line);

            // Store question and answer in the environmentQuestions array
            // The answer is expected to be 'true' or 'false'
            // $quiz_parts[0] is the question, $quiz_parts[1] is the answer
            $environmentQuestions[] = [
                'question' => trim($quiz_parts[0]),
                'answer' => trim($quiz_parts[1])
            ];
        }
    }
    ?>

    <div class="game-container">
        <p><strong>Player:</strong> <?php echo $name; ?></p>
        
        <h2>Environment Quiz</h2>
        <p>Welcome to the Environment Quiz! Answer the questions below by choosing True or False:</p>
        
        <form action="submit_game.php" method="post">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="topic" value="environment">
            
            <?php
            // Randomly shuffle and select 4 environment questions
            shuffle($environmentQuestions);
            $questionsToShow = array_slice($environmentQuestions, 0, 4);
            
            foreach ($questionsToShow as $index => $q) {
                $questionNum = $index + 1;
                echo '<div class="question">';
                echo '<p><strong>Question ' . $questionNum . ':</strong> ' . htmlspecialchars($q['question']) . '</p>';
                echo '<input type="radio" name="answers[' . $index . ']" value="true" required>True<br/>';
                echo '<input type="radio" name="answers[' . $index . ']" value="false">False<br/>';
                echo '</div><br/>';
            }
            ?>
            
            <input type="submit" value="Submit Answers">
            <a href="index.php"><button type="button">Back to Home</button></a>
        </form>

        <?php $_SESSION['current_questions'] = $questionsToShow; ?>
        
    </div>
</body>
</html>