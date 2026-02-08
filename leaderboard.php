<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Leaderboard</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>

<body>
	<?php
	// Reading Leaderboard file
	$leaderboardFile = 'data-files/leaderboard.txt';
	$players = [];

	// Check if the file exists before reading
	// Each line format: name,cumulative_points
	if (file_exists($leaderboardFile)) {
		$lines = file($leaderboardFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		foreach ($lines as $line) {
			$parts = explode(',', $line);
			if (count($parts) === 2) {
				$players[] = [
					'name' => trim($parts[0]),
					'points' => (int)trim($parts[1])
				];
			}
		}
	}

	// Determine sort order from GET parameter (default: by score descending)
	$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'score';

	if ($sortBy === 'name') {
		// Sort alphabetically by nickname (ascending)
		usort($players, function($a, $b) {
			return strcasecmp($a['name'], $b['name']);
		});
	} else {
		// Sort by greatest score (descending)
		usort($players, function($a, $b) {
			return $b['points'] - $a['points'];
		});
	}
	?>

	<header>
		<h1>Leaderboard</h1>
	</header>

	<!-- Sort options -->
	<div style="text-align: center;">
		<p>Sort by:</p>
		<a href="leaderboard.php?sort=score"><button type="button">Greatest Score</button></a>
		<a href="leaderboard.php?sort=name"><button type="button">Nickname</button></a>
	</div>

	<br/><br/>

	<?php if (!empty($players)): ?>
		<table border="1" cellpadding="10" cellspacing="0">
			<thead>
				<tr>
					<th>Rank</th>
					<th>Nickname</th>
					<th>Cumulative Points</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$rank = 1;
				foreach ($players as $player) {
					echo "<tr>";
					echo "<td>" . $rank . "</td>";
					echo "<td>" . htmlspecialchars($player['name']) . "</td>";
					echo "<td>" . $player['points'] . "</td>";
					echo "</tr>";
					$rank++;
				}
				?>
			</tbody>
		</table>
	<?php else: ?>
		<p style="text-align: center;">No players yet. Be the first to play!</p>
	<?php endif; ?>

	<br/>
	<div style="text-align: center;">
		<a href="submit_game.php"><button type="button">Back to Quiz</button></a>
		<a href="index.php"><button type="button">Back to Home</button></a>
	</div>
</body>
</html>