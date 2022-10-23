<?php 

	include('config/db_connect.php');

	// check GET request id param
	if(isset($_GET['pokedex_number'])){
		
		// escape sql chars
		$pokedex_number = mysqli_real_escape_string($conn, $_GET['pokedex_number']);

		// make sql
		$sql = "SELECT * FROM pokemon WHERE pokedex_number = '$pokedex_number'";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$pokemon = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>
<head>
	<style>
		.boxed {
 			border: 10px solid black;
			border-radius: 50px;
			display: inline;
			position:relative;
			
		}
		@font-face {
			font-family: "ketchum";
			src: url(./fonts/Ketchum.otf);
		}
		@font-face {
			font-family: "KOMIKAX";
			src: url(./fonts/KOMIKAX_.ttf);
		}
		h3 {
			color: #FFFF00;
			font-family: "KOMIKAX";
			font-weight: bold;
			font-size: 100px;
			-webkit-text-stroke: 2px #000000;
		}
		body {
		background-image: url("pWebImg/background.png");
	}
	</style>
</head>
	<?php include('templates/header.php'); ?>
<body >
	<div class="container center" style="background-image: url(./WebImg/pokeball.png); background-size: 250px 250px; background-repeat: no-repeat; background-attachment: fixed; background-position: 75% 60%;">
	<!-- if pokemon exisits prints the data below -->
		<?php if($pokemon): ?>
		<!-- Name displays the name in html and the php code will find the name in the pokemon name -->
		<img src="images/<?php echo htmlspecialchars($pokemon['name']); ?>.png" style="width: 250px;height: 250px;">

			<h3><img src="WebImg/name.png" style="width: 25px;height: 25px;"> Name: <?php echo $pokemon['name']; ?> (Pokedex Number:  <?php echo $pokemon['pokedex_number']; ?>)</h3>
			<h3><img src="WebImg/health.png" style="width: 25px;height: 25px;"> Total Health: <?php echo $pokemon['hp']; ?></h3>
			<h3><img src="WebImg/attack.png" style="width: 25px;height: 25px;"> Attack Damage: <?php echo $pokemon['attack']; ?></h3>
			<h3><img src="WebImg/defence.png" style="width: 45px;height: 25px;"> Defence Damage: <?php echo $pokemon['defence']; ?></h3>
			<h3><img src="WebImg/classification.png" style="width: 25px;height: 25px;"> Classification	: <?php echo $pokemon['classification']; ?></h3>
			<h3><img src="WebImg/abilites.png" style="width: 25px;height: 25px;"> Abilities	: <?php echo str_replace("'",'',str_replace(']','',str_replace('[', '', $pokemon['abilities']))); ?></h3>
			<h3><img src="WebImg/pokemonlogo.png" style="width: 25px;height: 25px;"> Primary Type: <?php echo $pokemon['type1']; ?></h3>

		<!-- ADD IN THE REMAINING DATA YOU WISH TO DISPLAY -->	
			
		<?php else: ?>
			<h5>No such pokemon exists. Please try again</h5>
		<?php endif ?>
	</div>

</body>

	<?php include('templates/footer.php'); ?>
			
</html>