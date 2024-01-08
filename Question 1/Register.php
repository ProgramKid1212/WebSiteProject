<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Form</title>
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
		padding: 20px;
		margin: auto;

	}
	
	h1 {
		text-align: center;
		font-size: 40px;
	}	
	
	form {
		<!-- text-align: center; -->
		font-size: 21px;
		left: 30px;
	}
	
	input {
		right: 10px;
		padding: 3px;
		width: 100%;
	}
	
	textarea {
		width: 100%;
	}
	
	.submit {
		margin: auto;
		width: 100%;
		color: #44A2F4;
		padding: 5px;
		font-size: 20px;
	}
</style>
</head>

<body>

	<?php 


	$first_name = $last_name = $phone_number = $email = $password = $fitness_goals = $workout = $fitness_level = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$servername = "localhost";
		$username = "root";
		$dbpassword = "";
		$dbname = "test";

		$conn = new mysqli($servername, $username, $dbpassword, $dbname);

		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		
		
		$first_name = validate_input($_POST["first_name"]);
		$last_name = validate_input($_POST["last_name"]);
		$phone_number = validate_input($_POST["phone_number"]);
		$email = validate_input($_POST["email"]);
		$password = validate_input($_POST["password"]);
		$fitness_goals = validate_input($_POST["fitness_goals"]);
		$workout = validate_input($_POST["workout"]);
		$fitness_level = validate_input($_POST["fitness_level"]);

		$sql = "SELECT email FROM members WHERE email = '" . $email . "'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			echo '<script>window.alert("This email address is already in use.");</script>';
			$conn->close();
		} else {
			$pre = $conn->prepare("INSERT INTO members (first_name, last_name, phone_number, email, password, fitness_goals, 
			workout_schedule, fitness_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			$pre->bind_param("ssssssss", $first_name, $last_name, $phone_number, $email, $password, $fitness_goals, $workout, $fitness_level);

			$pre->execute();
			
			$message = "Welcome ". $first_name . " " . $last_name . ". A registration email will sent to " . $email . ".";
			$text = '<script>window.alert("' . $message . '");</script>';
			echo $text;
			$pre->close();
			$conn->close();
		}
	}

	function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	?>

	<div>
		<h1>Registration Form</h1>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		<p>First Name:<br>
		<input type="text" name="first_name"><br></p>

		<p>Last Name:<br>
		<input type="text" name="last_name"><br></p>

		<p>Phone Number:<br>
		<input type="text" name="phone_number"><br></p>

		<p>Email:<br>
		<input type="text" name="email"><br></p>

		<p>Password:<br>
		<input type="text" name="password"><br></p>

		<p>Fitness Goals:<br>
		<textarea name="fitness_goals" ></textarea><br></p>

		<p>Workout Schedule:<br>
		<textarea name="workout"></textarea><br></p>

		<p>Fitness Level:<br>
		<textarea name="fitness_level"></textarea><br></p>

		<input type="submit" class="submit">
		</form>

		</div>

</body>

</html>
