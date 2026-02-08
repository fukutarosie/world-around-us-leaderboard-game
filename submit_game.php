<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quiz Result</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>

<body>
	<?php

	// Start the session to access session variables
	session_start();

	// Only process if this is a form submission (POST request)
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Retrieve the player's name and answers from the POST data
		$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Guest';
		$topic = isset($_POST['topic']) ? $_POST['topic'] : 'unknown';
		$submittedAnswers = isset($_POST['answers']) ? $_POST['answers'] : [];
		
		// Get the questions from session
		$questionsToShow = isset($_SESSION['current_questions']) ? $_SESSION['current_questions'] : [];
		
		$score = 0;
		$totalQuestions = count($questionsToShow);
		
		// Compare submitted answers with correct answers
		foreach ($questionsToShow as $index => $question) {
			if (isset($submittedAnswers[$index])) {
				// Case-insensitive comparison (trim whitespace)
				if (strtolower(trim($submittedAnswers[$index])) === strtolower(trim($question['answer']))) {
					$score++;
				}
			}
		}	
		
		$number_of_incorrect = $totalQuestions - $score;
		$quiz_points = ($score * 2) - ($number_of_incorrect * 1);

		// Initialize overall points if it doesn't exist
		if (!isset($_SESSION['overall_quizzes_points'])) {
			$_SESSION['overall_quizzes_points'] = 0;
		}
		
		// Store the scores in session autoglobal
		$_SESSION['overall_quizzes_points'] = $_SESSION['overall_quizzes_points'] + $quiz_points;
		$_SESSION['last_score'] = $score;
		$_SESSION['last_incorrect'] = $number_of_incorrect;
		$_SESSION['current_quiz_points'] = $quiz_points;
		
		// Redirect to prevent form resubmission on page refresh
		// Leaderboard file is only updated when the user clicks "Exit Game" (in result_page.php)
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit;
	}


	
	
	?>

	<div class="game-container" style="text-align: center;">
	<h1>Quiz Result</h1>
	<p><strong>Number of Correct:</strong> <?php echo isset($_SESSION['last_score']) ? $_SESSION['last_score'] : 0; ?></p>
	<p><strong>Number of Incorrect:</strong> <?php echo isset($_SESSION['last_incorrect']) ? $_SESSION['last_incorrect'] : 0; ?></p>
	<p><strong>Current Points This Quiz:</strong> <?php echo isset($_SESSION['current_quiz_points']) ? $_SESSION['current_quiz_points'] : 0; ?></p>
	<p><strong>Overall Points:</strong> <?php echo isset($_SESSION['overall_quizzes_points']) ? $_SESSION['overall_quizzes_points'] : 0; ?></p>
	
	<!-- Section 1: New Quiz -->
	<hr>
	<h2>New Quiz</h2>
	<p>Would you like to retake the quiz? Choose a topic:</p>
	<form method="post" action="animals_quiz.php">
		<button type="submit" name="topic" value="animals">Animals Quiz</button>
	</form>
	<form method="post" action="environment_quiz.php">
		<button type="submit" name="topic" value="environment">Environment Quiz</button>
	</form>
	
	<!-- Section 2: Leaderboard -->
	<hr>
	<h2>Leaderboard</h2>
	<form method="get" action="leaderboard.php">
		<button type="submit">View Leaderboard</button>
	</form>

	<!-- Section 3: Exit -->
	<hr>
	<form method = "post" action="result_page.php">
		<button type="submit" name="exit">Exit Game</button>
	</form>
	</div>
</body>
</html>
