<!DOCTYPE html>
<html>
	<head>
		<title>Civilian Data Entry</title>
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
			<h1>Civilian Data Entry Form</h1>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<label for="idquery">Which civilian are you entering?</label>
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
					  $query1 = "SELECT nobend_id, nobend_fname from non_benders WHERE nobend_fname LIKE '%$idquery%'";
					  $result1 = mysqli_query($con, $query1);

					  if(mysqli_num_rows($result1) > 0) {
						echo "<table>
						<tr>
						<th>Non-Bender ID</th>
						<th>Non-Bender First Name</th>
						</tr>";

						  while($row = mysqli_fetch_array($result1)) {
							echo "<tr>";
							echo "<td>" . $row['nobend_id'] . "</td>";
							echo "<td>" . $row['nobend_fname'] . "</td>";
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
				<label for="nobend_id">Non-Bender's ID from above table:*</label>
				<input type="number" id="nobend_id" name="nobend_id" min="1" max="999" required><br><br>
				<!----------------------------------------------------------->
				<label for="civ_profession">Civilian's Profession:</label>
				<input type="text" id="civ_profession" name="civ_profession"><br><br>
				<!----------------------------------------------------------->
				<label for="civ_location">Civilian's Location (city/town name):</label>		
				<input type="text" id="civ_location" name="civ_location"><br>	
				<!----------------------------------------------------------->
				<br><input type="submit" value="Submit">
			</form>
			<!--------------------------------------------------------------->
			<?php
			if(isset($_POST['nobend_id']) && $_POST['nobend_id'] != "") {
				$nobend_id = mysqli_real_escape_string($con, trim($_POST['nobend_id']));
				$civ_profession = mysqli_real_escape_string($con, trim($_POST['civ_profession']));
				$civ_location = mysqli_real_escape_string($con, trim($_POST['civ_location']));

				$query2 ="INSERT INTO civilian (nobend_id, civ_profession, civ_location) VALUES ('$nobend_id', '$civ_profession', '$civ_location')";
				$result2 = mysqli_query($con, $query2)
					or die("Error: Could not insert record");
				echo "One record for ".$nobend_id." added to civilian.";
			}
			?>

			<?php
			mysqli_close($con);
			?>
		</div>
	</body>
</html>
