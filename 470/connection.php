<?php 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
error_reporting(E_All & ~E_NOTICE)
?>
<?php
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

		$sql = "SELECT Sport, Year, School, OutcomeConf,OAoutcome FROM ScoresRankings ";
		
		if(isset($_POST['search_term'])){

			$search_term = $_POST['search_term'];


			$sql .= 'WHERE School = "' .$_POST['search_term'].'" OR Year = "'. $_POST['search_term'] .'" OR Sport = "'.$_POST['search_term'].'" ';

		


		}


?>
<form name="search_form" method="POST" action="buttons.php">
	Search: <input type="text" name="search_term" value=""/>
	<input type="submit" name="search" value="Search the table...">
</form>
</br>

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

