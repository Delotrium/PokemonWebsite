<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<?php 

	include('config/db_connect.php');

	// write query for all users
	$sql = 'SELECT * FROM `pokemon`;';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$pokemon = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free the $result from memory (good practise)
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
<head>
	<style>
	@font-face {
		font-family: "Komikax";
		src: url(./fonts/KOMIKAX_.ttf);
	}
	body {
		background-image: url(./WebImg/background.png);
			background-size: auto;
			background-repeat: y;
	}
	h2 {
		font-family: "Komikax";
		font-weight: bold;
		font-size: 100px;
		color: #ffffff;
		-webkit-text-stroke: 2px #000000;
	}
	h4 {
		font-family: "Komikax";
		font-weight: bold;
		font-size: 100px;
		color: #ffffff;
		-webkit-text-stroke: 2px #000000;
	}
	</style>
</head>
	<?php include('templates/header.php'); ?>
		<body>
		<h2 class="center black-text">Pokédex</h4>
		
		<div class="container">
			<div class="row">
			<div class="bgimage">
				<?php foreach($pokemon as $pokemon): ?>

					<div class="col s6 m4">
						<div class="card z-depth-0">
							<div class="card-content center" style="background-image: url(./WebImg/nature.png); background-size: cover;">
								<!-- The following will show the name and image -->
								<h4><?php echo htmlspecialchars($pokemon['name']); ?></h4>
								<img src="images/<?php echo htmlspecialchars($pokemon['name']); ?>.png">
								<!-- Add in the additional information here -->
								
							</div>
							<div class="card-action right-align">
								<a class="brand-text" href="info.php?pokedex_number=<?php echo $pokemon['pokedex_number'] ?>">more info</a>
							</div>
						</div>
					</div>
						
				<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php include('templates/footer.php'); ?>
		</body>
</html>