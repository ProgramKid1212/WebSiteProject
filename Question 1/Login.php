<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<style>
	body {
		background-color: black;	
		font-family: Helvetica;
	}

	div {
		background-color: #74baf7;
		width: 20%;
		height: 80%;
		border-style: solid;
		border-width: 15px;
		border-color: #44A2F4;
		padding: 10px;
		margin: auto;
		position: relative;
		top: 300px;

	}
	
	h1 {
		text-align: center;
		font-size: 40px;
	}	
	
	form {
		font-size: 21px;
		left: 30px;
	}
	
	input {
		right: 10px;
		padding: 3px;
		width: 50%;
	}
	
	
	.submit {
		margin: auto;
		width: 40%;
		color: #44A2F4;
		padding: 1px;
		font-size: 20px;
		position: relative;
		left: 125px;
	}
	
	a {
		position: relative;
		left: 145px;
	}
</style>
</head>
</head>

<?php

if 	($_SERVER["REQUEST_METHOD"] == "POST") {
	$servername = "localhost";
	$username = "root";
	$dbpassword = "";
	$dbname = "test";

	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	
	$email = validate_input($_POST["email"]);
	$password = validate_input($_POST["password"]);

	$sql = "SELECT password FROM members WHERE email='" .  $email . "'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if ($row["password"] == $password) {
			echo "Login Success.";
		} else {
			echo "The password is incorrect.";
		}
	} else {
		echo "This account does not exist.";
	}
	
	$conn->close();
}
	
function validate_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<div>
	<h2>Login Form</h2>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Email:<br>
		<input type="text" name="email"><br>
		
		Password:<br>
		<input type="text" name="password"><br><br>
		<input type="submit" value="Log in" class="submit">
	</form>
	
	<br>
	<a href="Register.php">Create an account</a><br>
	<a href="">Reset Password</a>

</div>

</html>
