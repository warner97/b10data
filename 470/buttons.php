<?php
error_reporting(E_ALL & ~E_NOTICE);
?>


</!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Scores And Rankings per Year</title>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css"/>

</head>

	<header style="background-color: #ffffff; border: 3px; border-color: #000000; text-align: center;">
		<img src="Images/B1G_logo.png" alt="BIG 10" width="184px" height="70px">
	</header>


<body>

	<div id="container">
		<div class="loggedin">
	</div>

	<table style="width:100%; padding-right: 30px">
		
	

	<div class="wrapper_left">
		<div class="button_grplft">
			<ul> 
				<li data-li="Illinois" class="btn"><img src="Images/illinois.png"></li>
				<li data-li="Indiana" class="btn"><img src="Images/indiana.png"></li>
				<li data-li="Iowa" class="btn"><img src="Images/iowa.png"></li>
				<li data-li="Minnesota" class="btn"><img src="Images/minnesota.png"></li>
				<li data-li="Nebraska" class="btn"><img src="Images/nebraska.png"></li>
				<li data-li="Northwestern" class="btn"><img src="Images/northwestern.png"></li>
				<li data-li="Purdue" class="btn"><img src="Images/purdue.png"></li>
				<li data-li="Wisconsin" class="btn"><img src="Images/wisconsin.png"></li>
			</ul>
	</div>
	<div class="item_grp">
		<div class="item">
			<div class="icon_wrap">
				<span class="icon"></span>
			</div>
			
		</div>
	</div>
		

<?php include'connection.php'?>
</body>
</html>