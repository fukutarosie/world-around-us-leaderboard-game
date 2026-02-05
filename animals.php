<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals Quiz - The World Around Us</title>
</head>

<body>
    <?php
    session_start();
    $name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest';
    ?>
    
    <header>
        <h1>The World Around Us - Animals Quiz</h1>
    </header>
    
    <div class="game-container">
        <p><strong>Player:</strong> <?php echo $name; ?></p>
        
        <h2>Animals Quiz</h2>
        <p>Welcome to the Animals Quiz! Answer the questions below:</p>
        
        <form action="submit_game.php" method="post">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="topic" value="animals">
            
            <div class="question">
                <p><strong>Question 1:</strong> What is the fastest land animal?</p>
                <input type="radio" name="q1" value="a" required> Cheetah<br/>
                <input type="radio" name="q1" value="b"> Horse<br/>
                <input type="radio" name="q1" value="c"> Lion<br/>
            </div>
            <br/>
            
            <div class="question">
                <p><strong>Question 2:</strong> How many legs does an octopus have?</p>
                <input type="radio" name="q2" value="a" required> 6<br/>
                <input type="radio" name="q2" value="b"> 8<br/>
                <input type="radio" name="q2" value="c"> 10<br/>
            </div>
            <br/>
            
            <input type="submit" value="Submit Answers">
            <a href="index.php"><button type="button">Back to Home</button></a>
        </form>
    </div>
</body>
</html>