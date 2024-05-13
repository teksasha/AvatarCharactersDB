<!DOCTYPE html>
<html>
	<head>
		<title>Non-Benders Search Form</title>
		<link rel="stylesheet" type="text/css" href="search.css">
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

				$con = mysqli_connect($host,$user,$password,$database)
					 or die ("Couldn't connect to server");
			?>

			<button type="button">
				<a href="http://web.simmons.edu/~tekeian/458/Avatar/home.html">Home</a>
			</button>
			<h1>Non-Benders Search Page</h1>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<label for="fnsearchquery">Search Non-Benders by First Name:</label>
				<input type="text" id="fnsearchquery" name="fnsearchquery">
				<br>
				<br>
				<input type="submit" value="Submit">
			</form>
			<br>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<label for="affilsearchquery">Search Non-Benders by Affiliation:</label>
				<input type="text" id="affilsearchquery" name="affilsearchquery">
				<br>
				<br>
				<input type="submit" value="Submit">
			</form>
			<br>

			<?php
				if(isset($_POST['fnsearchquery']) && $_POST['fnsearchquery'] != "") {
					  $fnsearchquery = mysqli_real_escape_string($con, trim($_POST['fnsearchquery']));
					  $query1 = "SELECT nb.nobend_fname AS nobend_fname, nb.nobend_lname, nb.nobend_affiliation, n.nation_name, s.show_name, r.narr_role FROM (((non_benders nb JOIN nations n ON (nb.nobend_nation = n.nation_id)) JOIN shows s ON (nb.nobend_show = s.show_id)) JOIN narrative_role r ON (nb.nobend_narr = r.narr_id)) WHERE nobend_fname LIKE '%$fnsearchquery%'";
					  $result1 = mysqli_query($con, $query1);

					  if(mysqli_num_rows($result1) > 0) {
						echo "<table>
						<tr>
						<th>Non-Bender First Name</th>
						<th>Non-Bender Last Name</th>
						<th>Non-Bender Affiliation</th>
						<th>Nation</th>
						<th>Show</th>
						<th>Narrative Role</th>
						</tr>";

						  while($row = mysqli_fetch_array($result1)) {
							echo "<tr>";
							echo "<td>" . $row['nobend_fname'] . "</td>";
							echo "<td>" . $row['nobend_lname'] . "</td>";
							echo "<td>" . $row['nobend_affiliation'] . "</td>";
							echo "<td>" . $row['nation_name'] . "</td>";
							echo "<td>" . $row['show_name'] . "</td>";
							echo "<td>" . $row['narr_role'] . "</td>";
							echo "</tr>";
						  }

						  echo "</table>";
					  }

					  else {
							 echo "No records matching your query were found. <br>";
					 }
				}

			?>
			<?php
				if(isset($_POST['affilsearchquery']) && $_POST['affilsearchquery'] != "") {
					  $affilsearchquery = mysqli_real_escape_string($con, trim($_POST['affilsearchquery']));
					  $query2 = "SELECT nb.nobend_fname AS nobend_fname, nb.nobend_lname, nb.nobend_affiliation, n.nation_name, s.show_name, r.narr_role FROM (((non_benders nb JOIN nations n ON (nb.nobend_nation = n.nation_id)) JOIN shows s ON (nb.nobend_show = s.show_id)) JOIN narrative_role r ON (nb.nobend_narr = r.narr_id)) WHERE nobend_affiliation LIKE '$affilsearchquery%'";
					  $result2 = mysqli_query($con, $query2);

					  if(mysqli_num_rows($result2) > 0) {
						echo "<table>
						<tr>
						<th>Non-Bender First Name</th>
						<th>Non-Bender Last Name</th>
						<th>Non-Bender Affiliation</th>
						<th>Nation</th>
						<th>Show</th>
						<th>Narrative Role</th>
						</tr>";

						  while($row = mysqli_fetch_array($result2)) {
							echo "<tr>";
							echo "<td>" . $row['nobend_fname'] . "</td>";
							echo "<td>" . $row['nobend_lname'] . "</td>";
							echo "<td>" . $row['nobend_affiliation'] . "</td>";
							echo "<td>" . $row['nation_name'] . "</td>";
							echo "<td>" . $row['show_name'] . "</td>";
							echo "<td>" . $row['narr_role'] . "</td>";
							echo "</tr>";
						  }

						  echo "</table>";
					  }

					  else {
							 echo "No records matching your query were found. <br>";
					 }
				}
			?>
			<?php mysqli_close($con);?>
		</div>
	</body>
</html>