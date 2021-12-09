<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
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

		$sql = "SELECT Sport, Year, School, Sport,OARank, Color FROM ScoresRankings where 1";

		if(($_POST['college'])){

			$sql .= ' and School = "' .$_POST['college'].'" ';

		}
		if (($_POST['year'])){

			$sql .= ' and Year = "' .$_POST['year'].'" ';

		}

		if (($_POST['sport'])){

			$sql .= ' and Sport = "' .$_POST['sport'].'" ';

		}
		
		$sql .= " order by Sport, School, Year";


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Big 10 Standings</title>
	<header>
		<style type="text/css">
			
			svg g:hover text {display: block;}
			#tooltip {
				position: absolute;
				width: 100px;
				height: auto;
				padding: 4px;
				background-color: white;
				-webkit-border-radius: 4px;
				-moz-border-radius: 4px;
				border-radius: 4px;
				-webkit-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.9);
				-moz-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.9);
				box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.9);
				pointer-events: none;
			}
			
			
			
			#tooltip p {
				margin: 0;
				font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
				font-size: 8px;
				line-height: 10px;
			}
			
			#g {
				font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
				font-size: 8px;
			}
		
			
		</style>

		
	</header>
	
</head>

<body>
	<br/><br/>
	<h style = "font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-size: 25px;text-align: right; padding-left:220px">Conference Standing Per Season</h><br/>
	
	<form name="filter" method="POST" action="standings.php" style="text-align:center; padding-top: 25px; padding-right: 300px;">
		<input type="text" name="college" placeholder="Enter School Name:" value="<?=$_REQUEST['college']?>">
		<select name="sport">
			<option value="">Select Sport</option>
			<?php 
			$sports = ["Football","Basketball","Volleyball"]; 

			foreach ($sports as $sport) {
				?>
			 <option value="<?php echo $sport; ?>" <?php if ($_POST["sport"]==$sport) echo "selected"?>><?php echo $sport;?></option>
				<?php
			}
			?>		 
		</select>
		<input type="submit" name="filter" value="Filter Data">
	</form>

			
<div id="tooltip" display="none" style="position: absolute; display: none;"></div>
	<svg xmlns="http://www.w3.org/2000/svg" width=700 height=300>
  		<g>
     	<line x1="240" y1="280" x2="560" y2="280" stroke ='black'></line> // bottom
     	
  		</g>
    <g class="labels x-labels" style ="font-size:10px">
	  <text x="240" y="300">2015</text>
	  <text x="290" y="300">2016</text>
    <text x="340" y="300">2017</text>
   	<text x="390" y="300">2018</text> 
   <text x="440" y="300">2019</text>
    <text x="490" y="300">2020</text>
    <text x="535"y="300">2021</text>
   <text x="390" y="350" class="label-title">Date</text>
		

<?php
$result = $conn->query($sql);
$x = 5;
		
$x1 = 0;
		if ($result->num_rows > 0) {
  		// output data of each row
			$row = $result->fetch_assoc();
			$year = $row["Year"];
			$school = $row["School"];
			$sport = $row["Sport"];
			$lineColor = $row["Color"];
			$fillColor = $row["Color"];
			$x1 =  ($row["Year"] - 2010)*50;
			$y1 = $row["OARank"] * 20;
			$rank = $row["OARank"];
?>
	<circle cx="<?php echo $x1;?>" cy="<?php echo $y1; ?>" r="3" stroke="<?php echo $lineColor;?>;" stroke-width="3" fill="<?php echo $fillColor;?>"onmousemove="showTooltip(evt, 'Standings: <?php echo $rank?>');" onmouseout="hideTooltip();"/></circle>			

	<?php
  			while($row = $result->fetch_assoc()) {
				$year = $row["Year"];
				$school = $row["School"];
				$sport = $row["Sport"];
				$lineColor = $row["Color"];
				$fillColor = $row["Color"];
              	$x2 =  ($row["Year"] - 2010)*50;
  			  	$y2 = $row["OARank"]*20;
				$rank = $row["OARank"];
	          	if ($x2>$x1){
					
					// you should change the style to make the color reflect the sport and school.
  				?>
	<line x1="<?php echo $x1;?>" x2="<?php echo  $x2;?>" y1="<?php echo $y1; ?>"  y2="<?php echo $y2; ?>" style="stroke:<?php echo $lineColor;?>;stroke-width:2" >
	</line>

	<circle cx="<?php echo $x2;?>" cy="<?php echo $y2; ?>" r="3" stroke="<?php echo $lineColor;?>;" stroke-width="3" fill="<?php echo $fillColor;?>"onmousemove="showTooltip(evt, 'Standings for <?php echo $row ["School"]?> for <?php echo $row["Sport"]?>: <?php echo $rank?>');" onmouseout="hideTooltip();"/></circle>
		
	
	

	  				<?php 
 
				
			  	} 
			  	$x1 = $x2;
				$y1 = $y2;
			  
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

</body>
</html>