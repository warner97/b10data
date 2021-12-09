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

		$sql = "SELECT Sport, Year, School, OutcomeConf,OAoutcome,Color,Color2 FROM ScoresRankings where 1 ";

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
	<h style="padding-left:250px; top; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-size: 25px;">Record Per Season</h>
	<title>Scores and Rankings</title>
	<header>
		<style type="text/css">
			
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
<br/>
	<form name="filter" method="POST" action="index.php"  style="text-align: left; padding-left:150px">
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
	<div id="tooltip" display="none" style="position: absolute; display: none;"></div>

	<svg xmlns="http://www.w3.org/2000/svg" width=400 height=400>


<?php
$result = $conn->query($sql);
$x = 0;
$poscol=$row["Color"];
$negcol=$row["Color2"];


		
		if ($result->num_rows > 0) {
  		// output data of each row
  			while($row = $result->fetch_assoc()) {

  				$height=  abs($row["OAoutcome"])* 5;
  					if ($row["OAoutcome"]<0){$y = 250 ; $barColor= '#373A36';}
  						else{$y=250-$height;$barColor= '#CEB888';} 
  				$outcome = [“OAoutcome”];
  				?>
  		<g>
     	<line x1="40" y1="250" x2="400" y2="250" stroke ='black'></line>
     	<line x1="40" y1="100" x2="40" y2="500" stroke= 'black'></line>
  		</g>
  <g>
    <rect  x="<?php $x=$x+50; echo $x;?>" y="<?php echo $y; ?>" width="20" height="<?php echo $height; ?>" fill="<?php echo $barColor;?>"
    	onmousemove="showTooltip(evt, 'Record for year <?php echo $row["Year"]?> in <?php echo $row["Sport"]?><br/><?php echo $row["OAoutcome"]?>');" onmouseout="hideTooltip();"/>
     </rect>
  </g>
    <g>
    <text x="<?php $x2=$x2+50; echo $x2;?>" y="270"><?php echo $row["Year"];?></text>
    
      </g>
  				<?php 
  			}
				} else {
  				echo "0 results";
				}
		
		$conn->close();

		?>
	
</svg>
<script>function showTooltip(evt, text) {
  let tooltip = document.getElementById("tooltip");
  tooltip.innerHTML = text;
  tooltip.style.display = "block";
  tooltip.style.left = evt.pageX + 10 + 'px';
  tooltip.style.top = evt.pageY + 10 + 'px';
}

function hideTooltip() {
  var tooltip = document.getElementById("tooltip");
  tooltip.style.display = "none";
}
</script>
<style type="text/css">
	rect:hover {
			fill: <?php echo $poscol;?>;
			}
</style>

</body>
</html>

