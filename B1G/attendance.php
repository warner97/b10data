<!DOCTYPE html>
<meta charset="utf-8">
<style>
circle:hover {
  opacity: 0.3;
}
    
div.tooltip {
  position: absolute;
  text-align: center;
  width: 150px;
  height: 40px;
  padding-top: 7px;
  color: white;
  font: 14px arial;
  background: black;
  border-radius: 8px;
  pointer-events: none; 
}
    
</style>
<html>
  <head>
	<script src="https://d3js.org/d3.v4.js"></script>
  </head>
	<h style="padding-left: 250px; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-size: 25px;">2019 Average Spectator Attendance</h><br/><br/><br/>
   
	<svg height="50" width="1000">
  
		<circle cx="600" cy="20" r="12" stroke="white" stroke-width="1" fill="#0088ce" />
       <text x="625" y="25" fill="black" style = "text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'" >= 1,000 spectators</text>
</svg>
<body>
	<div id="viz1" align="left"></div>
</body>
<script>
    
var div = d3
  .select("body")
  .append("div")
  .attr("class", "tooltip")
  .style("opacity", 0);

var drawGraph = function(){

	//number of circles to color in to visualize percent
	var attdNumberBball = 14;
  	var attdNumberFoot = 56; 
  	var attdNumberVball = 5; 
  

	//variables for the font family, and some colors
	var fontFamily =  "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'";
	var fillInactive = "white";
	var fillActive = "#0088ce";

	//width and height of the SVG
	const width = 500;
	const height = 500;

	//create an svg with width and height
	var svg = d3.select('#viz1')
		.append('svg')
		.attr("width", 1000)
		.attr("height", 400)
        .style('background-color', "white")
        
  
  //10 rows and 10 columns 
	var numRows = 10;
	var numCols = 10;

	//x and y axis scales
	var y = d3.scaleBand()
		.range([0,250])
		.domain(d3.range(numRows));

	var x = d3.scaleBand()
		.range([0, 250])
		.domain(d3.range(numCols));

	//the data is just an array of numbers for each cell in the grid
	var data = d3.range(numCols*numRows);

	//container to hold the grid
	var container = svg.append("g")
		.attr("transform", "translate(80,50)"); 

	container.selectAll("circle")
			.data(data)
			.enter().append("circle")
			.attr("id", function(d){return "id"+d;})
			.attr('cx', function(d){return x(d%numCols);})
			.attr('cy', function(d){return y(Math.floor(d/numCols));})
			.attr('r', 12)
			.attr('fill', function(d){return d < attdNumberBball ? fillActive : fillInactive;})
			.style('stroke', 'white')
            .on("mouseover", function (d) {
                div.transition().duration(200).style("opacity", 1);
                div.html("14,813" + "<br>" + "Spectators/Game")
                .style("left", d3.event.pageX + "px")
                .style("top", d3.event.pageY - 28 + "px");
                })
            .on("mouseout", function (d) {
                div.transition().duration(500).style("opacity", 0);
                })
            .append("text");
  
  container.append("text")
     .attr("x", 60)
     .attr("y", -30)
     .attr("stroke", "black")
     .text("Men's Basketball")
	 .attr("font-family", "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'");
  
  var container = svg.append("g")
        .attr("transform", "translate(380,50)");
  
  container.selectAll("circle")
			.data(data)
			.enter().append("circle")
			.attr("id", function(d){return "id"+d;})
			.attr('cx', function(d){return x(d%numCols);})
			.attr('cy', function(d){return y(Math.floor(d/numCols));})
			.attr('r', 12)
			.attr('fill', function(d){return d < attdNumberFoot ? fillActive : fillInactive;})
			.style('stroke', 'white')
            .on("mouseover", function (d) {
                div.transition().duration(200).style("opacity", 1);
                div.html("56,530" + "<br>" + "Spectators/Game")
                .style("left", d3.event.pageX + "px")
                .style("top", d3.event.pageY - 28 + "px");
                })
            .on("mouseout", function (d) {
                div.transition().duration(500).style("opacity", 0);
                })
      .append("text");
  
  container.append("text")
     .attr("x", 80)
     .attr("y", -30)
     .attr("stroke", "black")
     .text("Football")
	 .attr("font-family", "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'");
  
  var container = svg.append("g")
        .attr("transform", "translate(680,50)");
  
  container.selectAll("circle")
			.data(data)
			.enter().append("circle")
			.attr("id", function(d){return "id"+d;})
			.attr('cx', function(d){return x(d%numCols);})
			.attr('cy', function(d){return y(Math.floor(d/numCols));})
			.attr('r', 12)
			.attr('fill', function(d){return d < attdNumberVball ? fillActive : fillInactive;})
			.style('stroke', 'white')
            .on("mouseover", function (d) {
                div.transition().duration(200).style("opacity", 1);
                div.html("5,026" + "<br>" + "Spectators/Game")
                .style("left", d3.event.pageX + "px")
                .style("top", d3.event.pageY - 28 + "px");
                })
            .on("mouseout", function (d) {
                div.transition().duration(500).style("opacity", 0);
                })
      .append("text");
  
  container.append("text")
     .attr("x", 50)
     .attr("y", -30)
     .attr("stroke", "black")
     .text("Women's Volleyball")
	 .attr("font-family", "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'");

}

	//call function to draw the graph
	drawGraph();
</script>

    
</html>

