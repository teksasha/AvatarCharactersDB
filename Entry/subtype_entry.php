<!DOCTYPE html>
<html>
	<head>
		<title>Bending Subtype Data Entry</title>
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
			<h1>Bending Subtype Data Entry Form</h1>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<label for="idquery">Which bender are you entering?</label>
				<input type="text" id="idquery" name="idquery">
				<br>
				<br>
				<input type="submit" value="Submit">
			</form>
			<br>
			<!--------------------------------------------------------------->
			<?php
				if(isset($_POST['idquery']) && $_POST['idquery'] != "") {
					  $idquery = mysqli_real_escape_string($con, trim($_POST['idquery']));
					  $query1 = "SELECT bend_id, bend_fname from benders WHERE bend_fname LIKE '%$idquery%'";
					  $result1 = mysqli_query($con, $query1);

					  if(mysqli_num_rows($result1) > 0) {
						echo "<table>
						<tr>
						<th>Bender ID</th>
						<th>Bender First Name</th>
						</tr>";

						  while($row = mysqli_fetch_array($result1)) {
							echo "<tr>";
							echo "<td>" . $row['bend_id'] . "</td>";
							echo "<td>" . $row['bend_fname'] . "</td>";
							echo "</tr>";
						  }
						  echo "</table>";
					  }

					  else {
							 echo "No records matching your query were found. <br>";
					 }
				}
			?>
			<hr>
			<br>
			<!--------------------------------------------------------------->
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
				<label for="bend_id">Bender's ID from above table:*</label>
				<input type="number" id="bend_id" name="bend_id" min="1" max="999" required><br><br>
				<!----------------------------------------------------------->
				Avatar's Primary Bending Type:<br>
				<input type="radio" id="water" name="bend_type" value="water">
				<label for="water">Water</label><br>
				<input type="radio" id="earth" name="bend_type" value="earth">
				<label for="earth">Earth</label><br>
				<input type="radio" id="fire" name="bend_type" value="fire">
				<label for="fire">Fire</label><br>
				<input type="radio" id="air" name="bend_type" value="air">
				<label for="air">Air</label><br>
				<!----------------------------------------------------------->
				<label for="bend_subtype">Bending Subtype(s):</label>
				<input type="text" id="bend_subtype" name="bend_subtype"><br><br>
				<!----------------------------------------------------------->
				<br><input type="submit" value="Submit">
			</form>
			<!--------------------------------------------------------------->
			<?php
			if(isset($_POST['bend_id']) && $_POST['bend_id'] != "") {
				$bend_id = mysqli_real_escape_string($con, trim($_POST['bend_id']));
				$bend_type = mysqli_real_escape_string($con, trim($_POST['bend_type']));
				$bend_subtype = mysqli_real_escape_string($con, trim($_POST['bend_subtype']));

				$query2 ="INSERT INTO bender_subtype (bend_id, bend_type, bend_subtype) VALUES ('$bend_id', '$bend_type', '$bend_subtype')";
				$result2 = mysqli_query($con, $query2)
					or die("Error: Could not insert record");
				echo "One record for ".$bend_id." added to avatar.";
			}
			?>

			<?php
			mysqli_close($con);
			?>
		</div>
	</body>
</html>
