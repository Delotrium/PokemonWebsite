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

	<?php include('templates/header.php'); ?>

	<div class="container center">
	<!-- if pokemon exisits prints the data below -->
		<?php if($pokemon): ?>
		<!-- Name displays the name in html and the php code will find the name in the pokemon name -->
		<img src="images/<?php echo htmlspecialchars($pokemon['name']); ?>.png" style="width: 250px;height: 250px;">
 		<h4><img src="WebImg/name.png" style="width: 25px;height: 25px;"> Name: <?php echo $pokemon['name']; ?> (Pokedex Number:  <?php echo $pokemon['pokedex_number']; ?>)</h4>
		<h4><img src="WebImg/health.png" style="width: 25px;height: 25px;"> Total Health: <?php echo $pokemon['hp']; ?></h4>
		<h4><img src="WebImg/attack.png" style="width: 25px;height: 25px;"> Attack Damage: <?php echo $pokemon['attack']; ?></h4>
		<h4><img src="WebImg/defence.png" style="width: 45px;height: 25px;"> Defence Damage: <?php echo $pokemon['defence']; ?></h4>
		<h4><img src="WebImg/classification.png" style="width: 25px;height: 25px;"> Classification	: <?php echo $pokemon['classification']; ?></h4>
		<h4><img src="WebImg/abilites.png" style="width: 25px;height: 25px;"> Abilities	: <?php echo str_replace(']','',str_replace('[', '', $pokemon['abilities'])); ?></h4>
		<h4><img src="WebImg/pokemonlogo.png" style="width: 25px;height: 25px;"> Primary Type: <?php echo $pokemon['type1']; ?></h4>


		<!-- ADD IN THE REMAINING DATA YOU WISH TO DISPLAY -->	
			
		<?php else: ?>
			<h5>No such pokemon exists. Please try again</h5>
		<?php endif ?>
	</div>

	<body>
		<a href="https
		</body>
	<?php include('templates/footer.php'); ?>
			
</html>