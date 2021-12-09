<?php
error_reporting(E_ALL & ~E_NOTICE);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
		<title>Revenue, Expenses, and Profit</title>

	
	

    <link rel="stylesheet" type="text/css" href="style_profitability.css"/>
	
</head>

	</header> 
	
<body>

	<div id="container">
		<div class="loggedIn">
    </div>
		
	
   
		

<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/charts.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<?php
	$connection = mysqli_connect("va.tech.purdue.edu", "cgt2021f", "cgtdatavis", "cgt470_2021_g5");

	//check connection
if (!$connection){
	die ("Error: could not connect.". mysqli_connect_error());
}

//perform querys against a database
$query = "SELECT School, Revenue, Expenses, Color FROM RevenueExpensesProfit";
	//$result is the query result
$result = mysqli_query($connection, $query);
?>
  

    <div class="bodytext">
    	<h style="text-align: top; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-size: 25px; padding-left:250px">Profitability Per University</h><br/><br/>
    </div>

</div>

<div id="chartdiv"></div><br/>
<script type="text/javascript">




var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.plotContainer.background.strokeWidth = 1;
chart.plotContainer.background.strokeOpacity = 1;
chart.plotContainer.background.stroke = am4core.color("#00000");
	

chart.data = [
 	<?php
	$row=mysqli_fetch_array($result);
	echo "{'school':'".$row["School"]."', 'expenses':".$row["Expenses"].", 'revenue':".$row["Revenue"].", 'color':'".$row["Color"]."'}";
	while ($row=mysqli_fetch_array($result)){
		echo ",\n{'school':'".$row["School"]."', 'expenses':".$row["Expenses"].", 'revenue':".$row["Revenue"].", 'color':'".$row["Color"]."'}";
		
		
	} ?>];
	/* 
[{ "school": "Northwestern",
  "expenses": 0,
  "revenue": 0,
  "color": "#4E2A84"
}, {
  "school": "Ohio State",
  "expenses": 215209566,
  "revenue": 233871740,
  "color": "#666666"
}, {
  "school": "Iowa",
  "expenses": 149161886,
  "revenue": 145636544, 
  "color": "#FFCD00"
}, {
  "school": "Indiana",
  "expenses": 120289560,
  "revenue": 121181042,
  "color": "#990000"
}, {
  "school": "Penn State",
  "expenses": 157908311,
  "revenue": 165077390,
  "color": "#041E42"
}, {
  "school": "Wisconsin",
  "expenses": 149196055,
  "revenue": 148198907,
  "color": "#C5050C"
}, {
  "school": "Rutgers",
  "expenses": 114203981,
  "revenue": 103642415,
  "color": "#CC0033"
}, {
  "school": "Nebraska",
  "expenses": 120582125,
  "revenue": 133629080,
  "color": "#E41C38"
}, {
  "school": "Minnesota",
  "expenses": 124818508,
  "revenue": 119280297,
  "color": "#7A0019"
}, {
  "school": "Illinois",
  "expenses": 121638435,
  "revenue": 122566259,
  "color": "#E84A27"
}, {
  "school": "Michigan State",
  "expenses": 148453353,
  "revenue": 130636629,
  "color": "#18453B"
}, {
  "school": "Michigan",
  "expenses": 180841523,
  "revenue": 192403168,
  "color": "#00274C"
}, {
  "school": "Purdue",
  "expenses": 99012032,
  "revenue": 102223618,
  "color": "#CEB888"
}, {
  "school": "Maryland",
  "expenses": 92231361,
  "revenue": 92286469,
  "color": "#000000"
}];
*/

var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "school";
categoryAxis.renderer.inversed = true;
categoryAxis.renderer.grid.template.location = 1;
categoryAxis.renderer.minGridDistance = 20;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minGridDistance = 100;
valueAxis.renderer.baseGrid.zIndex = 0.5;

var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.zIndex = 2;
columnSeries.dataFields.categoryY = "school";
columnSeries.dataFields.valueX = "revenue";
columnSeries.dataFields.openValueX = "expenses";
columnSeries.columns.template.tooltipText = "[bold]{categoryY}[/]\nExpenses: {openValueX}\  Revenue: {valueX}";

var columnTemplate = columnSeries.columns.template;
columnTemplate.zIndex = 2;
columnTemplate.strokeOpacity = 0;
columnTemplate.propertyFields.fill = "color";
columnTemplate.height = am4core.percent(100);
	
</script>

</body>
</html>