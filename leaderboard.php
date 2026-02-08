<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Leaderboard - The World Around Us</title>
</head>

<body>
	<?php
	// Start the session to access session variables
	session_start();
	?>
	
	<header>
		<h1>Leaderboard - The World Around Us</h1>
	</header>

	<?php
	// Load leaderboard data
	$leaderboardFile = 'data-files/leaderboard.txt';
	$playersData = [];
	
	if (file_exists($leaderboardFile)) {
		$lines = file($leaderboardFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		
		// Process each line: name, current_quiz_points, overall_quiz_points
		foreach ($lines as $line) {
			$parts = explode(',', $line);
			if (count($parts) === 3) {
				$name = trim($parts[0]);
				$currentPoints = (int)trim($parts[1]);
				$overallPoints = (int)trim($parts[2]);
				
				// Store all attempts for each player
				if (!isset($playersData[$name])) {
					$playersData[$name] = [
						'name' => $name,
						'attempts' => [],
						'overall_points' => 0
					];
				}
				
				// Add this quiz attempt
				$playersData[$name]['attempts'][] = $currentPoints;
				// Keep the latest (highest) overall points
				$playersData[$name]['overall_points'] = max($playersData[$name]['overall_points'], $overallPoints);
			}
		}
	}
	
	// Sort by overall points (descending)
	usort($playersData, function($a, $b) {
		return $b['overall_points'] - $a['overall_points'];
	});
	?>

	<div class="leaderboard-container">
		<h2>All Players Rankings</h2>
		
		<?php if (!empty($playersData)): ?>
			<table border="1" cellpadding="10" cellspacing="0">
				<thead>
					<tr>
						<th>Rank</th>
						<th>Player Name</th>
						<th>Number of Attempts</th>
						<th>Latest Quiz Points</th>
						<th>Overall Points</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$rank = 1;
					foreach ($playersData as $player) {
						$numAttempts = count($player['attempts']);
						$latestQuizPoints = end($player['attempts']);
						echo "<tr>";
						echo "<td>" . $rank . "</td>";
						echo "<td>" . htmlspecialchars($player['name']) . "</td>";
						echo "<td>" . $numAttempts . "</td>";
						echo "<td>" . $latestQuizPoints . "</td>";
						echo "<td>" . $player['overall_points'] . "</td>";
						echo "</tr>";
						$rank++;
					}
					?>
				</tbody>
			</table>
		<?php else: ?>
			<p>No players yet. Be the first to play!</p>
		<?php endif; ?>
		
		<br/>
		<a href="index.php"><button type="button">Back to Home</button></a>
		<a href="submit_game.php"><button type="button">Back to Results</button></a>
	</div>
</body>
</html>
