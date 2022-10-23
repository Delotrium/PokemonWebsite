

<?php
	include('config/db_connect.php');
    if(isset($_POST['submit'])) {
        $pokemonOneNumber = $_POST['MainPokemon'];
        $pokemonTwoNumber = $_POST['DuelPokemon'];
    }
    $pokedex_number_one = $pokemonOneNumber;
    $pokedex_number_two = $pokemonTwoNumber;
    // make sql
    $sqlOne = "SELECT * FROM pokemon WHERE pokedex_number = '$pokedex_number_one'";
    $sqlTwo = "SELECT * FROM pokemon WHERE pokedex_number = '$pokedex_number_two'";
    // get the query result
    $resultOne = mysqli_query($conn, $sqlOne);
    $resultTwo = mysqli_query($conn, $sqlTwo);
    // fetch result in array format
    $pokemonOne = mysqli_fetch_assoc($resultOne);
    $pokemonTwo = mysqli_fetch_assoc($resultTwo);
    mysqli_free_result($resultOne);
    mysqli_free_result($resultTwo);
    mysqli_close($conn);

    function CompareIcon($datapoinOne, $datapointTwo) {
        if($datapoinOne > $datapointTwo) {
            return "./compareICON/up.png";
        } elseif($datapoinOne < $datapointTwo) {
            return "./compareICON/down.png";
        } elseif($datapoinOne == $datapointTwo) {
            return "./compareICON/stable.png";
        };
    }

   function Winner($attackOne, $attackTwo, $defenceOne, $defenceTwo, $healthOne, $healthTwo, $specDOne, $specDTwo, $specAOne, $SpATWO) {
    $calcOne = (($defenceTwo + ($specDTwo/$defenceTwo))^2 - ($attackOne + ($specAOne/$attackOne))^2)/((($defenceOne - $attackOne)^2)+1); 
    $calcTwo = (($defenceOne + ($specDOne/$defenceOne))^2 - ($attackTwo + ($SpATWO /$attackTwo))^2)/((($defenceTwo - $attackTwo)^2) + 1);
    if($calcOne > $calcTwo) {
        return "winner";
    } else {
        return "loser";
    }
   }
?>

<!DOCTYPE html>
<html>
<head>
    <style>
		@font-face {
			font-family: 'FuturaHandwritten';
			src: url(./fonts/FuturaHandwritten.ttf);
		}
		h1 {
			font-family: 'FuturaHandwritten', sans-sarif;
			font-weight:bold;
			-webkit-text-stroke: 1px #000000;
		}
        th {
			font-family: 'FuturaHandwritten', sans-sarif;
			font-weight:bold;
            font-size: 25px;
			-webkit-text-stroke: 1px #000000;
		}


	</style>
</head>
<?php include('templates/header.php'); ?>
    <body>
        <div class="container center">
            <?php if($pokemonOne): ?>
                <table>
                    <tr>
                        <th><img src="images/<?php echo htmlspecialchars($pokemonOne['name']); ?>.png" style="width: 150px;height: 150px;"></th>
                        <th><img src="images/<?php echo htmlspecialchars($pokemonTwo['name']); ?>.png" style="width: 150px;height: 150px;"></th>
                    </tr>
                    <tr>
                        <th>Name: <?php echo $pokemonOne['name']; ?> (Pokedex Number:  <?php echo $pokemonOne['pokedex_number']; ?>)</th>
                        <th>Name: <?php echo $pokemonTwo['name']; ?> (Pokedex Number:  <?php echo $pokemonTwo['pokedex_number']; ?>)</th>
                    </tr>
                        <th>Total Health: <?php echo $pokemonTwo['hp']; ?> <img src="<?php echo CompareIcon($pokemonTwo['hp'], $pokemonOne['hp'])?>" style="width: 40px;height: 40px;"></th>
                        <th>Total Health: <?php echo $pokemonOne['hp']; ?> <img src="<?php echo CompareIcon($pokemonOne['hp'], $pokemonTwo['hp'])?>" style="width: 40px;height: 40px;"></th>
                    <tr>
                        <th>Attack Damage: <?php echo $pokemonOne['attack'];?> <img src="<?php echo CompareIcon($pokemonOne['attack'], $pokemonTwo['attack'])?>" style="width: 40px;height: 40px;"></th>
                        <th>Attack Damage: <?php echo $pokemonTwo['attack']?> <img src="<?php echo CompareIcon($pokemonTwo['attack'], $pokemonOne['attack'])?>" style="width: 40px;height: 40px;"></th>
                    </tr>
                    <tr>
                        <th>Special Attack Damage: <?php echo $pokemonOne['sp_attack']; ?> <img src="<?php echo CompareIcon($pokemonOne['sp_attack'], $pokemonTwo['sp_attack'])?>" style="width: 40px;height: 40px;"></th>
                        <th>Special Attack Damage: <?php echo $pokemonTwo['sp_attack']; ?> <img src="<?php echo CompareIcon($pokemonTwo['sp_attack'], $pokemonOne['sp_attack'])?>" style="width: 40px;height: 40px;"></th>
                    </tr>
                    <tr>
                        <th>Defence Damage: <?php echo $pokemonOne['defence']; ?> <img src="<?php echo CompareIcon($pokemonOne['defence'], $pokemonTwo['defence'])?>" style="width: 40px;height: 40px;"></th>
                        <th>Defence Damage: <?php echo $pokemonTwo['defence']; ?> <img src="<?php echo CompareIcon($pokemonTwo['defence'], $pokemonOne['defence'])?>" style="width: 40px;height: 40px;"></th>
                    </tr>
                    <tr>
                        <th>Special Defence Damage: <?php echo $pokemonOne['sp_defense']; ?> <img src="<?php echo CompareIcon($pokemonOne['sp_defense'], $pokemonTwo['sp_defense'])?>" style="width: 40px;height: 40px;"></th>
                        <th>Special Defence Damage: <?php echo $pokemonTwo['sp_defense']; ?> <img src="<?php echo CompareIcon($pokemonTwo['sp_defense'], $pokemonOne['sp_defense'])?>" style="width: 40px;height: 40px;"></th>
                    </tr>
                    <tr>
                <?php if(Winner($pokemonOne['attack'], $pokemonTwo['attack'], $pokemonOne['defence'], $pokemonTwo['defence'], $pokemonOne['hp'], $pokemonTwo['attack'], $pokemonOne['sp_defense'], $pokemonTwo['sp_defense'], $pokemonOne['sp_attack'], $pokemonTwo['sp_attack']) == "winner"):?>
                    <th><h1 style="color: #00FF00"> WINNER! </h1></th>
                    <th><h1 style="color: #FF0000">LOSER!</h1></th>
                <?php elseif(Winner($pokemonOne['attack'], $pokemonTwo['attack'], $pokemonOne['defence'], $pokemonTwo['defence'], $pokemonOne['hp'], $pokemonTwo['attack'], $pokemonOne['sp_defense'], $pokemonTwo['sp_defense'], $pokemonOne['sp_attack'], $pokemonTwo['sp_attack']) == "loser"):?>
                    <th><h1 style="color: #FF0000"> LOSER! </h1></th>
                    <th><h1 style="color: #00FF00">WINNER!</h1></th>
                <?php endif?>
                    </tr>
                </table>
            <?php else: ?>
			    <h5>No such pokemon exists. Please try again</h5>
            <?php endif?>
        </div>    
    </body>
</html>