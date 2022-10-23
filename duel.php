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
		p {
			font-family: "ketchum";
			font-weight: bold;
			font-size: 50px;
			-webkit-text-stroke: 0.25px #FFFFFF;
	</style>
</head>
<form name="pokedexnumber" action="fight.php" method="post">
    <p>Pokedex Number of Main Pokemon: <input type="text" name="MainPokemon"/></p>
    <p>Pokedex Number of Duelling Pokemon: <input type="text" name="DuelPokemon"/></p>
    <p><input type="submit" name="submit" value="Duel Pokemon"/></p>       
</form>

</html>