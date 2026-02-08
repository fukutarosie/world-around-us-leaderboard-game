<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Game Over - The World Around Us</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>

<body>
	<?php
	session_start();

	// Get current game data from session before destroying it
	$playerName = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
	$currentGamePoints = isset($_SESSION['overall_quizzes_points']) ? $_SESSION['overall_quizzes_points'] : 0;

	// Update leaderboard file with cumulative points (all games per user)
	$leaderboardFile = 'data-files/leaderboard.txt';
	$players = [];

	// Read existing leaderboard data
	if (file_exists($leaderboardFile)) {
		$lines = file($leaderboardFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		foreach ($lines as $line) {
			$parts = explode(',', $line);
			if (count($parts) === 2) {
				$name = trim($parts[0]);
				$points = (int)trim($parts[1]);
				$players[$name] = $points;
			}
		}
	}

	// Add current game points to existing cumulative total for this player
	if (isset($players[$playerName])) {
		$players[$playerName] += $currentGamePoints;
	} else {
		$players[$playerName] = $currentGamePoints;
	}

	$cumulativePoints = $players[$playerName];

	// Write updated leaderboard back to file (one line per player: name,cumulative_points)
	$fileContent = '';
	foreach ($players as $name => $points) {
		$fileContent .= $name . ',' . $points . PHP_EOL;
	}
	file_put_contents($leaderboardFile, $fileContent);

	// Destroy the session (game is over)
	session_destroy();
	?>

	<div class="game-container" style="text-align: center;">
	<h1>Game Over</h1>
	<hr>
	<p><strong>Nickname:</strong> <?php echo htmlspecialchars($playerName); ?></p>
	<p><strong>Overall Points (All Games):</strong> <?php echo $cumulativePoints; ?></p>
	<hr>

	<h2>Start a New Game</h2>
	<form method="post" action="index.php">
		<button type="submit">Play Again</button>
	</form>
	</div>
</body>
</html>