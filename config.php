<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	<?php

  $con = mysqli_connect("va.tech.purdue.edu", "cgt2021f", "cgtdatavis", "cgt470_2021_g5");
    // Check connection
    if (!$con) {
     die("Connection failed: " . mysqli_connect_error());
    }

    $chartQuery = "SELECT OARank, Sport, Year, School FROM ScoresRankings WHERE 1 ORDERBY Year";
    $chartQueryRecords = mysqli_query($con,$chartQuery);
?>
	
</body>
</html>