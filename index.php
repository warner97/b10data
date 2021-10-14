<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project - Index</title>

	</head>

	<header style="background-color:#000; color:#FFF; text-align:left; font-size:36pt; font-family:Georgia, 'Times New Roman', Times, serif">
		<span style="font-size:24px; font-family:Arial, Helvetica, sans-serif">Data</span>
	</header>

<body>

	<div id="container">
		<div class="loggedIn">
    </div>
   

<?php
		$servername = "va.tech.purdue.edu";
		$username = "cgt2021f";
		$password = "cgtdatavis";
		$dbname = "cgt2021f";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
  			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT Artist, Album, Sold_Claimed FROM BestSellingAlbums";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
  		// output data of each row
  			while($row = $result->fetch_assoc()) {
    		echo "Artist: " . $row["Artist"]. "Album" . $row["Album"]. "Sold Claimed" . $row["Sold_Claimed"]. "<br>";
  			}
				} else {
  				echo "0 results";
				}
		
		$conn->close();
?>
  

    <div class="bodytext">
    	<p>"This is a test page."</p>
    </div>

</div>

<script type="text/javascript">
	document.getElementById("userID").focus();
</script>

</body>
</html>