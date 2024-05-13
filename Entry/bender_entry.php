<!DOCTYPE html>
<html>
	<head>
		<title>Bender Data Entry</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="entry.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
	</head>
	<body>
		<div class="background">
			<?php
			$host="canary.simmons.edu";
			$user="tekeian";
			$password="4004911";
			$database="lis45801sp23_tekeian_1";
			#------------------------------------------------------
			$con = mysqli_connect($host,$user,$password,$database)
				or die ("Couldn't connect to server");
			?>

			<button type="button">
				<a href="http://web.simmons.edu/~tekeian/458/Avatar/home.html">Home</a>
			</button>
			<h1>Bender Data Entry Form</h1>
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
				<label for="bend_fname">Bender's First Name:*</label>
				<input type="text" id="bend_fname" name="bend_fname" required><br><br>
				<!----------------------------------------------------------->
				<label for="bend_lname">Bender's Last Name:</label>
				<input type="text" id="bend_lname" name="bend_lname"><br><br>
				<!----------------------------------------------------------->
				Bending Type:*<br>
				<input type="radio" id="water" name="bend_type" value="water" required>
				<label for="water">Water</label><br>
				<input type="radio" id="earth" name="bend_type" value="earth">
				<label for="earth">Earth</label><br>
				<input type="radio" id="fire" name="bend_type" value="fire">
				<label for="fire">Fire</label><br>
				<input type="radio" id="air" name="bend_type" value="air">
				<label for="air">Air</label><br>
				<input type="radio" id="avatar" name="bend_type" value="avatar">
				<label for="avatar">Avatar</label><br><br>
				<!----------------------------------------------------------->
				<label for="bend_nation">Bender's Nation:*</label>
				<select name="bend_nation" id="bend_nation" required>
				   <option value="1">Earth Kingdom</option>
				   <option value="2">Fire Nation</option>
				   <option value="3">Air Nomads</option>
				   <option value="4">Southern Water Tribe</option>
				   <option value="5">Northern Water Tribe</option>
				   <option value="6">Red Lotus</option>
				   <option value="7">United Republic</option>
				</select><br><br>
				<!----------------------------------------------------------->
				<label for="bend_narr">Bender's Narrative Role:</label>
				<select name="bend_narr" id="bend_narr">
				   <option value="1">Protagonist</option>
				   <option value="2">Antagonist</option>
				   <option value="3">Neutral</option>
				   <option value="4">Both Pro- and Ant-</option>
				</select><br><br>
				<!----------------------------------------------------------->
				Bender's Show:*<br>
				<input type="radio" id="1" name="bend_show" value="1" required>
				<label for="1">Avatar: The Last Airbender</label><br>
				<input type="radio" id="2" name="bend_show" value="2">
				<label for="2">The Legend of Korra</label><br>
				<!----------------------------------------------------------->
				<br>
				<input type="submit" value="Submit">
			</form>
			<br>

			<?php
			if(isset($_POST['bend_fname']) && $_POST['bend_fname'] != "") {
				$bend_fname = mysqli_real_escape_string($con, trim($_POST['bend_fname']));
				$bend_lname = mysqli_real_escape_string($con, trim($_POST['bend_lname']));
				$bend_type = mysqli_real_escape_string($con, trim($_POST['bend_type']));
				$bend_nation = mysqli_real_escape_string($con, trim($_POST['bend_nation']));
				$bend_narr = mysqli_real_escape_string($con, trim($_POST['bend_narr']));
				$bend_show = mysqli_real_escape_string($con, trim($_POST['bend_show']));
			#---------------------------------------------------------------------------------
				$query ="INSERT INTO benders (bend_fname, bend_lname, bend_type, bend_nation, bend_narr, bend_show) VALUES ('$bend_fname', '$bend_lname', '$bend_type', '$bend_nation', '$bend_narr', '$bend_show')";
			#---------------------------------------------------------------------------------
				$result = mysqli_query($con, $query)
					or die("Error: Could not insert bender record");
			#---------------------------------------------------------------------------------
				echo "One record for ".$bend_fname. " ".$bend_lname." added to benders.";
			}
			mysqli_close($con);
			?>

			<h2>Next Step:</h2>
			<button type="button">
				<a href="http://web.simmons.edu/~tekeian/458/Avatar/Entry/avatar_entry.php">Enter Avatar Info</a>
			</button>
			<button type="button">
				<a href="http://web.simmons.edu/~tekeian/458/Avatar/Entry/subtype_entry.php">Enter Bending Subtype Info</a>
			</button>
		</div>
	</body>
</html>