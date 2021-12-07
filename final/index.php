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

		if(($_POST['college'])){

			$sql .= ' and School = "' .$_POST['college'].'" ';

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
	<header>
		<style type="text/css">
			rect:hover {
			fill: red;
			}
			svg g:hover text {display: block;}
			#tooltip {
				position: absolute;
				width: 200px;
				height: auto;
				padding: 10px;
				background-color: white;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
				-webkit-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.9);
				-moz-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.9);
				box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.9);
				pointer-events: none;
			}
			
			#tooltip.hidden {
				display: none;
			}
			
			#tooltip p {
				margin: 0;
				font-family: sans-serif;
				font-size: 16px;
				line-height: 20px;
			}
		</style>
		<script src="https://d3js.org/d3.v4.min.js"></script>
	</header>
	
</head>

<body>

	<form name="filter" method="POST" action="index.php" style="text-align:center; padding-top: 50px; padding-right: 800px;">
		<input type="text" name="college" placeholder="Enter School Name:" value="<?=$_REQUEST['college']?>">
		<select name="sport">
			<option value="">Select Sport</option>
			<?php $sports = ["Football","Basketball","Volleyball"]; 

			foreach ($sports as $sport) {
				// code...
				?>
			 <option value="<?php echo $sport; ?>" <?php if ($_POST["sport"]==$sport) echo "selected"?>><?php echo $sport;?></option>
				<?php
			}
			?>		 
		</select>
		<input type="submit" name="filter" value="Filter Data">
	</form>

	<svg xmlns="http://www.w3.org/2000/svg" width=1000 height=1000>


<?php
$result = $conn->query($sql);
$x = 5;
		
		if ($result->num_rows > 0) {
  		// output data of each row
  			while($row = $result->fetch_assoc()) {

  				$height=  abs($row["OAoutcome"])* 10;
  					if ($row["OAoutcome"]<0){$y = 300 ; $barColor="#0000cc";}
  						else{$y=300-$height;$barColor="#cc6600";} 
  				?>
  		<g>
     	<line x1="45" y1="300" x2="800" y2="300" stroke ='black'></line>
     	<line x1="45" y1="0" x2="45" y2="600" stroke= 'black'></line>
  		</g>
  <g>
    <rect x="<?php $x=$x+80; echo $x;?>" y="<?php echo $y; ?>" width="20" height="<?php echo $height; ?>" fill="<?php echo $barColor;?>"></rect>
    <text><?php echo $row["OAoutcome"];?> </text>
    
  </g>
    <g>
    <text x="<?php $x=$x+27; echo $x;?>" y="320" style="stroke:rgb(0,0,0);stroke-width:1" ><?php echo $row["Year"];?></text>
    
      </g>
  				<?php 
  			}
				} else {
  				echo "0 results";
				}
		
		$conn->close();

		?>
	
</svg>
</body>
</html>

