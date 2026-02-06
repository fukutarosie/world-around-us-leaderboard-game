<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample HTML Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php

    // session_start() is used to start a new session or resume an existing one
    // isset is used to check if the $_POST variables has been set (the form has been submitted) , 
    // header() is used to redirect to the appropriate quiz page based on the selected topic
    // session_start() is used to start a new session or resume an existing one

    session_start();
    if (isset($_POST['name']) && isset($_POST['quiz-topic'])) {
        switch ($_POST['quiz-topic']) 
        {
            case 'animals':
                $_SESSION['name'] = $_POST['name'];
                header('Location: animals_quiz.php');
                exit();
                
            case 'environment':
                $_SESSION['name'] = $_POST['name'];
                header('Location: environment_quiz.php');
                exit();
        }
    }

?>
    <header>
        <h1>The World Around Us</h1>
    </header>
    <form id="gameStartForm" name="gameStartForm" method="post">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br/>

        <label>Select Quiz Topic:</label>
        <br/>

        <input type="radio" id="animals" name="quiz-topic" value="animals" required>
        <label for="animals">Animals</label>
        <br/>

        <input type="radio" id="environment" name="quiz-topic" value="environment">
        <label for="environment">Environment</label>
        <br/>

        <input type="submit" value="Start Game">
        <br/>

    </form>
</body> 
</html>
