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
	<?php include('templates/header.php'); ?>

	<h4 class="center black-text" style="background-color:#0be595;">Pokédex</h4>

	<div class="container">
		<div class="row">

			<?php foreach($pokemon as $pokemon): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<!-- The following will show the name and image -->
							<h6>Name: <?php echo htmlspecialchars($pokemon['name']); ?></h6>
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

	<?php include('templates/footer.php'); ?>

</html>