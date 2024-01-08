<!DOCTYPE html>
<html>
<head>
<title>Guest Registration</title>
<style>
	body {
		background-color: black;	
		font-family: Helvetica;
		color: black;
	}

	div.main {
		background-color: #5CDB95;
		width: 35%;
		height: 80%;
		border-style: solid;
		border-width: 15px;
		border-color: #05386B;
		border-radius: 20px;
		padding: 10px;
		margin: auto;

	}
	
	div.check {
		border-style: solid;
		border-width: 3px;
		border-radius: 15px;
		border-color: #44A2F4;
		padding: 5px;
	}
	
	h1 {
		text-align: center;
		font-size: 40px;
		color: white;
		-webkit-text-stroke-width: 1px;
		-webkit-text-stroke-color: black;
	}
	
	h3 {
		text-align: center;
		font-size: 27px;
		color: white;
		-webkit-text-stroke-width: 1px;
		-webkit-text-stroke-color: black;
	}
	
	form {
		font-size: 21px;
		left: 30px;
	}
	
	.textbox {
		width: 98%;
		padding: 8px;
		display: inline-block;
		border: 1px solid #ccc;
	}
	
	textarea {
		width: 98%;
		padding: 8px;
		border: 1px solid #ccc;
		
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
		$first_name = $last_name = $title = $gender = $phone_number = $email = "";
		$expertise = $day = $descrip = "";
		$stall = $panel = "0";
	
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
			$title = validate_input($_POST["title"]);
			$gender = validate_input($_POST["gender"]);
			$phone_number = validate_input($_POST["phone_number"]);
			$email = validate_input($_POST["email"]);
			$expertise = validate_input($_POST["expertise"]);
			$day = validate_input($_POST["day"]);
			$descrip = validate_input($_POST["descrip"]);
			$stall = validate_input($_POST["stall"]);
			$panel = validate_input($_POST["panel"]);
			
			$pre = $conn->prepare("INSERT INTO guests (first_name, last_name, title, gender, 
			phone_number, email, expertise, day, descrip, stall, panel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$pre->bind_param("sssssssssss", $first_name, $last_name, $title, $gender, 
			$phone_number, $email, $expertise, $day, $descrip, $stall, $panel);

			$pre->execute();

			echo "New records created successfully";

			$pre->close();
			$conn->close();

		}
	
		function validate_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	
	?>
	
	<div class="main">
		<h1>Kimiko Entertainment</h1>
		<h3>Guest Registration</h3>
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			<p>First Name:<br>
			<input type="text" name="first_name" class="textbox"><br></p>
			
			<p>Last Name:<br>
			<input type="text" name="last_name" class="textbox"><br></p>
			
			<p>Preferred Title:<br>
			<input type="text" name="title" class="textbox"><br></p>
			
			<div class="check">
				<p>Gender:
				<input type="radio" name="gender" value="male">Male
				<input type="radio" name="gender" value="female">Female
				<input type="radio" name="gender" value="other">Other<br></p>
			</div>
			
			<p>Phone Number:<br>
			<input type="text" name="phone_number" class="textbox"><br></p>
			
			<p>Email:<br>
			<input type="text" name="email" class="textbox"><br></p>
			
			<p>Area of Expertise:<br>
			<textarea name="expertise"></textarea><br></p>
			
			<div class="check">
				<p>Preferred Day to Attend: 
				<input type="radio" name="day" value="2023-05-12">12 May
				<input type="radio" name="day" value="2023-05-13">13 May
				<input type="radio" name="day" value="2023-05-14">14 May<br></p>
			</div>
			
			<p>Description:<br>
			<textarea name="descrip"></textarea><br></p>
			
			<p>Do you intend to have a stall?:
			<input type="checkbox" name="stall" value="1"><br></p>
			
			<p>Do you want to host a panel?:
			<input type="checkbox" name="panel" value="1"><br></p>
			
			<input type="submit" class="submit">
		</form>
	</div>
</body>


</html>