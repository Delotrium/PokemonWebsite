<?php

	include('config/db_connect.php');

	$firstName = $lastName = $email = $password = '';
	$errors = array('firstName' => '', 'lastName' => '', 'email' => '', 'password' => '');

	if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		// check firstName
		if(empty($_POST['firstName'])){
			$errors['firstName'] = 'A first name is required';
		} else{
			$firstName = $_POST['firstName'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $firstName)){
				$errors['firstName'] = 'First Name must be letters and spaces only';
			}
		}
		// check lastName
		if(empty($_POST['lastName'])){
			$errors['lastName'] = 'A last name is required';
		} else{
			$lastName = $_POST['lastName'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $lastName)){
				$errors['lastName'] = 'Last Name must be letters and spaces only';
			}
		}

		// check password
		if(empty($_POST['password'])){
			$errors['password'] = 'An password is required';
		} else{
			$password = $_POST['password'];
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
			$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			
			// create sql
			$sql = "INSERT INTO users(firstName,lastName,email,password) VALUES('$firstName','$lastName','$email','$password')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

			
		}

	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Create an Account</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your First Name</label>
			<input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName) ?>">
			<div class="red-text"><?php echo $errors['firstName']; ?></div>
			<label>Your Last Name</label>
			<input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName) ?>">
			<div class="red-text"><?php echo $errors['lastName']; ?></div>
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Your Password</label>
			<input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
			<div class="red-text"><?php echo $errors['password']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>