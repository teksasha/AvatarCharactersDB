<!DOCTYPE html>
<html>
	<head>
	  <title>Non-Bender Data Entry</title>
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
			<h1>Non-Bender Data Entry Form</h1>
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
				<label for="nobend_fname">Non-Bender's First Name:*</label>
				<input type="text" id="nobend_fname" name="nobend_fname" required><br><br>
				<!----------------------------------------------------------->
				<label for="nobend_lname">Non-Bender's Last Name:</label>
				<input type="text" id="nobend_lname" name="nobend_lname"><br><br>
				<!----------------------------------------------------------->
				Non-Bender's Affiliation:*<br>
				<input type="radio" id="civ" name="nobend_affiliation" value="civ" required>
				<label for="civ">Civilian</label><br>
				<input type="radio" id="nociv" name="nobend_affiliation" value="nociv">
				<label for="nociv">Non-Civilian (Government, Military, etc.)</label><br>
				<input type="radio" id="animal" name="nobend_affiliation" value="animal">
				<label for="animal">Animal</label><br><br>
				<!----------------------------------------------------------->
				<label for="nobend_nation">Non-Bender's Nation:*</label>
				<select name="nobend_nation" id="nobend_nation" required>
				   <option value="1">Earth Kingdom</option>
				   <option value="2">Fire Nation</option>
				   <option value="3">Air Nomads</option>
				   <option value="4">Southern Water Tribe</option>
				   <option value="5">Northern Water Tribe</option>
				   <option value="6">Red Lotus</option>
				   <option value="7">United Republic</option>
				</select><br><br>
				<!----------------------------------------------------------->
				<label for="nobend_narr">Non-Bender's Narrative Role:</label>
				<select name="nobend_narr" id="nobend_narr">
				   <option value="1">Protagonist</option>
				   <option value="2">Antagonist</option>
				   <option value="3">Neutral</option>
				   <option value="4">Both Pro- and Ant-</option>
				</select><br><br>
				<!----------------------------------------------------------->
				Non-Bender's Show:*<br>
				<input type="radio" id="1" name="nobend_show" value="1" required>
				<label for="1">Avatar: The Last Airbender</label><br>
				<input type="radio" id="2" name="nobend_show" value="2">
				<label for="2">The Legend of Korra</label><br><br>
				<!----------------------------------------------------------->
				<br><input type="submit" value="Submit">
			</form>
			<br>

			<?php
			if(isset($_POST['nobend_fname']) && $_POST['nobend_fname'] != "") {
				$nobend_fname = mysqli_real_escape_string($con, trim($_POST['nobend_fname']));
				$nobend_lname = mysqli_real_escape_string($con, trim($_POST['nobend_lname']));
				$nobend_affiliation = mysqli_real_escape_string($con, trim($_POST['nobend_affiliation']));
				$nobend_nation = mysqli_real_escape_string($con, trim($_POST['nobend_nation']));
				$nobend_narr = mysqli_real_escape_string($con, trim($_POST['nobend_narr']));
				$nobend_show = mysqli_real_escape_string($con, trim($_POST['nobend_show']));
			#---------------------------------------------------------------------------------
				$query ="INSERT INTO non_benders (nobend_fname, nobend_lname, nobend_affiliation, nobend_nation, nobend_narr, nobend_show) VALUES ('$nobend_fname', '$nobend_lname', '$nobend_affiliation', '$nobend_nation', '$nobend_narr', '$nobend_show')";
			#---------------------------------------------------------------------------------
				$result = mysqli_query($con, $query)
					or die("Error: Could not insert record");
			#---------------------------------------------------------------------------------
				echo "One record for ".$nobend_fname. " ".$nobend_lname." added to non-benders.";
			}
			mysqli_close($con);
			?>

			<h2>Next Step:</h2>
			<button type="button">
				<a href="http://web.simmons.edu/~tekeian/458/Avatar/Entry/civilian_entry.php">Enter Civilian Information</a>
			</button>
			<button type="button">
				<a href="http://web.simmons.edu/~tekeian/458/Avatar/Entry/noncivilian_entry.php">Enter Non-Civilian Information</a>
			</button>
			<button type="button">
				<a href="http://web.simmons.edu/~tekeian/458/Avatar/Entry/animal_entry.php">Enter Animal Information</a>
			</button>
		</div>
	</body>
</html>
