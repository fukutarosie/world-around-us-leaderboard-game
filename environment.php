<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environment Quiz - The World Around Us</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    session_start();
    $name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest';
    ?>
    
    <header>
        <h1>The World Around Us - Environment Quiz</h1>
    </header>
    
    <div class="game-container">
        <p><strong>Player:</strong> <?php echo $name; ?></p>
        
        <h2>Environment Quiz</h2>
        <p>Welcome to the Environment Quiz! Answer the questions below:</p>
        
        <form action="submit_game.php" method="post">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="topic" value="environment">
            
            <div class="question">
                <p><strong>Question 1:</strong> What gas do plants absorb from the atmosphere?</p>
                <input type="radio" name="q1" value="a" required> Oxygen<br/>
                <input type="radio" name="q1" value="b"> Nitrogen<br/>
                <input type="radio" name="q1" value="c"> Carbon Dioxide<br/>
            </div>
            <br/>
            
            <div class="question">
                <p><strong>Question 2:</strong> Which of these is a renewable energy source?</p>
                <input type="radio" name="q2" value="a" required> Coal<br/>
                <input type="radio" name="q2" value="b"> Solar Energy<br/>
                <input type="radio" name="q2" value="c"> Natural Gas<br/>
            </div>
            <br/>
            
            <input type="submit" value="Submit Answers">
            <a href="index.php"><button type="button">Back to Home</button></a>
        </form>
    </div>
</body>
</html>