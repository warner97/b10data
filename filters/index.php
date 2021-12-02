<?php
error_reporting(E_ALL & ~E_NOTICE);
$servername = "va.tech.purdue.edu";
		$username = "cgt2021f";
		$password = "cgtdatavis";
		$dbname = "cgt470_2021_g5";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
  			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT Sport, Year, School, OutcomeConf,OAoutcome FROM ScoresRankings where 1 ";

		if(($_POST['q'])){

			$schools=$_POST['q'];

			$sql .= ' and School = "' .$_POST['q'].'" ';

		}
		if (($_POST['year'])){

			$sql .= ' and Year = "' .$_POST['year'].'" ';

		}

		if (($_POST['sport'])){

			$sql .= ' and Sport = "' .$_POST['sport'].'" ';

		}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Scores and Rankings</title>
	<header style="background-color: #FFFFFF; border: 3px; border-color: #000000; text-align: center;padding-right: px;">
		<img src="Images/B1G_logo.png" width="184px" height="70px">
	</header>
	<table style="width:100%; padding-right: 30px;">
		<tr>
			<th style="font-size: 25px; font-family:Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', 'sans-serif'; text-align:left; ; padding-left: 300px;"> West Division</th>
			<th style="font-size: 25px; font-family:Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', 'sans-serif'; text-align:right; padding-right: 400px;"> East Division</th>
		</tr>
		<tr>
			<td style="padding-left: 200px;">
				</br>
				<img src="Images/illinois.png" alt="Illinois" width="32px" height="32px" title="Illinois"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/iowa.png" alt="Iowa" width="32px" height="32px" title="Iowa"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/minnesota.png" alt="Minnesota" width="32px" height="32px" title="Minnesota"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/nebraska.png" alt="Nebraska" width="32px" height="32px" title="Nebraska"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/northwestern.png" alt="Northwestern" width="32px" height="32px" title="Northwestern"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/purdue.png" alt="Purdue" width="32px" height="32px" title="Purdue"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/wisconsin.png" alt="Wisconsin" width="32px" height="32px" title="Wisconsin"> &nbsp;&nbsp;&nbsp;&nbsp;
			
			</td>
			<td style="padding-left:450px;">
				<img src="Images/indiana.png" alt="Indiana" width="32px" height="32px" title="Indiana"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/maryland.png" alt="Maryland" width="32px" height="32px" title="Maryland"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/umich.png" alt="University of Michigan" width="32px" height="32px" title="University of Michigan"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/msu.png" alt="Michigan State University" width="32px" height="32px" title="Michigan State"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/osu.png" alt="Ohio State University" width="32px" height="32px" title="Ohio State"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/penn_state.png" alt="Penn State" width="32px" height="32px" title="Penn State"> &nbsp;&nbsp;&nbsp;&nbsp;
				<img src="Images/rutgers.png" alt="Rutgers" width="32px" height="32px" title="Rutgers"> &nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>
</head>

<body>

	<form name="schools" method="POST" action="index.php" style="text-align:center;">
		<input type="text" name="q" placeholder="School" value="<?=$_REQUEST['q']?>">
		<select name="sport">
			<option value="">Sport</option>
			<?php $sports = ["Men's Football","Men's Basketball","Women's Volleyball"]; 

			foreach ($sports as $sport) {
				// code...
				?>
			 <option value="<?php echo $sport; ?>" <?php if ($_POST["sport"]==$sport) echo "selected"?>><?php echo $sport;?></option>
				<?php
			}
			?>
		 
		</select>

		<select name="year">
			<option value="">Year</option>
			<?php

			for ( $year=2015;$year<2021;$year++){ ?>
			 <option value="<?php echo $year; ?>" <?php if ($_POST["year"]==$year) echo "selected"?>><?php echo $year;?></option>
				<?php

			}
			?>
		</select>
		<input type="submit" name="filter" value="Filter Data">
	</form>

<?php
$result = $conn->query($sql);

		
		if ($result->num_rows > 0) {
  		// output data of each row
  			while($row = $result->fetch_assoc()) {
    		echo "Sport: " . $row["Sport"]. "&nbsp;". "Year: " . $row["Year"].  "&nbsp;". "School: " . $row["School"]. "&nbsp;". "OutcomeConf: " . $row["OutcomeConf"]."&nbsp;"."OAoutcome: " . $row["OAoutcome"]. "<br>";
  			}
				} else {
  				echo "0 results";
				}
		
		$conn->close();

		?>


</body>
</html>

