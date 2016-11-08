<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
	svg {
	    background: transparent;
	    margin-top: -2em;
	}
	.tooltip {
	  position: absolute;
	  width: 200px;
	  height: 120px;
	  pointer-events: none;
	  padding: 8px;
	  border-radius: 10px;
	}
	.axis path{
	    fill: none;
	    display: none;
	}
	.axis line {
	    fill: none;
	    stroke: #c1c1c1;
	    shape-rendering: crispEdges;
	}
	
	/*graph styling time*/
	#lineGraph img {
	    opacity: 0.07;
	    position: absolute;
	    width: 1400px;
	    margin-top: 7em;
	}
	
	.tick text{
	    font-family: sans-serif;
	    font-size: 12px;
	    opacity: .8;
	}
	
	.y.axis text{
	    transform: translate(-1335px, 0px);
	}
	
	/*style the radio buttons adapted code from http://codepen.io/AngelaVelasquez/pen/Eypnq*/
	h2 {
	color: #A9A9A9;
	font-weight: normal;
	}
	
	.container svg{
	    margin-top: -3em;
	}
	
	.container ul{
	  list-style: none;
	  width: 100%;
	  margin: 0;
	  padding: 0;
	}
	
	
	.container ul li{
	  color: #A9A9A9;
	  display: block;
	  position: relative;
	  float: left;
	}
	
	.container ul li input[type=radio]{
	  position: absolute;
	  visibility: hidden;
	}
	
	.container ul li label{
	  display: block;
	  position: relative;
	  font-weight: 300;
	  font-size: 1.35em;
	  padding: 25px 25px 0px 60px;
	  margin: 10px auto;
	  height: 30px;
	  z-index: 9;
	  cursor: pointer;
	  -webkit-transition: all 0.25s linear;
	}
	
	.container ul li:hover label{
		color: #0075BF;
	}
	
	.container ul li .check{
	  display: block;
	  position: absolute;
	  border: 5px solid #A9A9A9;
	  border-radius: 100%;
	  height: 25px;
	  width: 25px;
	  top: 30px;
	  left: 20px;
		z-index: 5;
		transition: border .25s linear;
		-webkit-transition: border .25s linear;
	}
	
	.container ul li .checkBox{
	  display: block;
	  position: absolute;
	  border: 5px solid #A9A9A9;
	  border-radius: 10%;
	  height: 25px;
	  width: 25px;
	  top: 30px;
	  left: 20px;
		z-index: 5;
		transition: border .25s linear;
		-webkit-transition: border .25s linear;
	}
	
	.container ul li:hover .check {
	  border: 5px solid #0075BF;
	}
	.container ul li:hover .checkBox {
	  border: 5px solid #0075BF;
	}
	
	.container ul li .check::before {
	  display: block;
	  position: absolute;
		content: '';
	  border-radius: 100%;
	  height: 15px;
	  width: 15px;
	  top: 5px;
		left: 5px;
	  margin: auto;
		transition: background 0.25s linear;
		-webkit-transition: background 0.25s linear;
	}
	
	.container ul li .checkBox::before {
	    display: block;
	  position: absolute;
		content: '';
	  border-radius: 10%;
	  height: 15px;
	  width: 15px;
	  top: 5px;
		left: 5px;
	  margin: auto;
		transition: background 0.25s linear;
		-webkit-transition: background 0.25s linear;
	}
	
	/*when checked*/
	input[type=radio]:checked ~ .check {
	  border: 5px solid #009CFF;
	}
	
	input[type=radio]:checked ~ .check::before{
	  background: #009CFF;
	}
	
	input[type=radio]:checked ~ label{
	  color: #009CFF;
	}
	
	input[type=checkbox]:checked ~ .checkBox {
	  border: 5px solid #009CFF;
	}
	
	input[type=checkbox]:checked ~ .checkBox::before{
	  background: #009CFF;
	}
	
	input[type=checkbox]:checked ~ label{
	  color: #009CFF;
	}
</style>
<script type="text/javascript">
	var nbaTeamChamp = {1985:"LAL",1986:"BOS",1987:"LAL",1988:"LAL",1989:"DET",1990:"DET",1991:"CHI",1992:"CHI",1993:"CHI",1994:"HOU",1995:"HOU",1996:"CHI",1997:"CHI",1998:"CHI",1999:"SAS",2000:"LAL",2001:"LAL",2002:"LAL",2003:"SAS",2004:"DET",2005:"SAS",2006:"MIA",2007:"SAS",2008:"BOS",2009:"LAL",2010:"LAL",2011:"DAL",2012:"MIA",2013:"MIA",2014:"SAS", 2015:"GSW"};
	var nbaColorsAbbreviated = {"ATL": {"first": "#01244C", "third": "#D21033"},
 "BOS": {"first": "#05854C", "second": "#EAEFE9",  "third": "#FFFFFF"},
 "CHA": {"first": "#F26532" , "second":  "#29588B" },
 "CHI": {"first": "#D4001F", "second": "#000000", "third":"#FFFFFF"},
"CLE":{"first":"#9F1425","second":"#003375", "third":"#B99D6A"},
 "DAL": {"first": "#006AB5", "second": "#F0F4F7"}, 
"DEN": {"first":  "#4393D1", "second": "#FBB529"},
"DET": {"first":"#ED174C", "second":"#006BB6"},
"GSW": {"first": "#FDB927", "second": "#006bb6", "third": "#FFC33C"},
"HOU": {"first":"#CC0000", "second":"#FFFFFF"},
"IND": {"first": "#002E62",  "second":"#FFC225"},
"LAC": {"first":"#EE2944", "second": "#146AA2", "third": "#FFFFFF" },
"LAL": {"first":"#4A2583", "second":"#F5AF1B"},
"MEM": {"first": "#001B41", "second":"#85A2C6", "third":"#FFFFFF"},
"MIA": {"first":  "#B62630", "second":"#1E3344","third": "#FF9F00"},
"MIL": {"first": "#00330A", "second": "#C82A39"},
"MIN": {"first": "#015287", "second": "#000000", "third": "#EFEFEF"},
"NJN": {"first":"#002258", "second":"#D32E4C", "third":"#EFEFF1"},
"NOH": {"first":  "#008FC5", "second": "#FDC221"},
"NOK": {"first":  "#008FC5", "second": "#FDC221"},
"NOP": {"first":  "#0095CA", "second": "#1D1060", "third": "#FEBB25"},
"NYK": {"first":"#2E66B2", "second":"#FF5C2B" },
"OKC": {"first": "#0075C1", "second":"#E7442A","third":"#002553"},
"ORL": {"first": "#077ABD","second":"#C5CED5","third":"#000000"},
"PHI": {"first": "#C5003D", "second": "#000000", "third": "#C7974D" },
"PHO": {"first": "#48286C", "second":"#FF7A31","third": "#FFBC1E" },
"POR": {"first": "#000000", "second": "#E1393E", "third": "#B4BDC3" },
"SAS": {"first": "#000000", "second": "#BEC8C9", "thrid": "#FFFFFF" },
"SAC": {"first": "#743389", "second":"#DCE2E4", "thrid": "#000000"},
"SEA": {"first":"#5831", "second":"#A71B28" },
"TOR": {"first":"#CD1041", "second":"#ECEBE9", "third":"#000000"},
"UTA": {"first":"#001D4D","second":"#448CCE",  "third":"#480975"},
"WAS": {"first":"#004874","third":"#BC9B6A" }};


	var nbaColors = {"Atlanta Hawks": {"first": "#01244C", "second": "#D21033"},
 "Boston Celtics": {"first": "#05854C", "second": "#EAEFE9",  "third": "#FFFFFF"},
 "Charlotte Bobcats": {"first": "#F26532" , "second":  "#29588B" },
 "Chicago Bulls": {"first": "#D4001F", "second": "#000000", "third":"#FFFFFF"},
"Cleveland Cavaliers":{"first":"#9F1425","second":"#003375", "third":"#B99D6A"},
 "Dallas Mavericks": {"first": "#006AB5", "second": "#F0F4F7"}, 
"Denver Nuggets": {"first":  "#4393D1", "second": "#FBB529"},
"Detroit Pistons": {"first":"#ED174C", "second":"#006BB6"},
"Golden State Warriors": {"first": "#FDB927", "second": "#006bb6", "third": "#FFC33C"},
"Houston Rockets": {"first":"#CC0000", "second":"#FFFFFF"},
"Indiana Pacers": {"first": "#002E62",  "second":"#FFC225"},
"Los Angeles Clippers": {"first":"#EE2944", "second": "#146AA2", "third": "#FFFFFF" },
"Los Angeles Lakers": {"first":"#4A2583", "second":"#F5AF1B"},
"Memphis Grizzlies": {"first": "#001B41", "second":"#85A2C6", "third":"#FFFFFF"},
"Miami Heat": {"first":  "#B62630", "second":"#1E3344","third": "#FF9F00"},
"Milwaukee Bucks": {"first": "#00330A", "second": "#C82A39"},
"Minnesota Timberwolves": {"first": "#015287", "second": "#000000", "third": "#EFEFEF"},
"New Jersey Nets": {"first":"#002258", "second":"#D32E4C", "third":"#EFEFF1"},
"New Orleans Hornets": {"first":  "#0095CA", "second": "#1D1060", "third": "#FEBB25"},
"New York Knicks": {"first":"#2E66B2", "second":"#FF5C2B" },
"Oklahoma City Thunder": {"first": "#0075C1", "second":"#E7442A","third":"#002553"},
"Orlando Magic": {"first": "#077ABD","second":"#C5CED5","third":"#000000"},
"Philadelphia 76ers": {"first": "#C5003D", "second": "#000000", "third": "#C7974D" },
"Phoenix Suns": {"first": "#48286C", "second":"#FF7A31","third": "#FFBC1E" },
"Portland Trail Blazers": {"first": "#000000", "second": "#E1393E", "third": "#B4BDC3" },
"San Antonio Spurs": {"first": "#000000", "second": "#BEC8C9", "thrid": "#FFFFFF" },
"Sacramento Kings": {"first": "#743389", "second":"#DCE2E4", "thrid": "#000000"},
"Toronto Raptors": {"first":"#CD1041", "second":"#ECEBE9", "third":"#000000"},
"Utah Jazz": {"first":"#001D4D","second":"#448CCE",  "third":"#480975"},
"Washington Wizards": {"first":"#004874","second":"#BC9B6A" }};
</script>

</head>

<body>

<div class="container">
  <ul>
  <li>
    <input type="radio" id="f-option" name="threePoints" value="TPP" onclick="updateData(value)" checked>
    <label for="f-option">3P%</label>
    
    <div class="check"></div>
  </li>
  
  <li>
    <input type="radio" id="s-option" name="threePoints" value="TPA" onclick="updateData(value)">
    <label for="s-option">3PA</label>
    
    <div class="check"><div class="inside"></div></div>
  </li>
  
  <li>
    <input type="checkbox" id="leagueAvg" onclick="addLeagueAverage()" hidden='true'>
    <label for="leagueAvg">League Average</label>
    <div class="slider"></div>
    <div class="checkBox"><div class="inside"></div></div>
  </li>
</ul>
</div>

<div id="lineGraph">
    <img src="https://jalendice13.files.wordpress.com/2015/08/cropped-121210092244-nba-logo-wordmark-275-wide-story-top.jpg">
</div>


<script type="text/javascript">
	var isPercent = true;
	var loadedAvgs = false;
	var lgHeight = 750;
	var lgWidth = 1400;
	var axesOffset = 100;
	var champYear = [];
	var champTeam = [];
	var threeAttempts = [];
	var threePercent = [];
	var avgThreeAttempts =[];
	var avgThreePercent = [];
	var avgAge = [];
	
	var svg = d3.select("#lineGraph").append("svg")
	.attr("width", lgWidth)
	.attr("height", lgHeight);
	
	var xScale = d3.scale.linear()
				.domain([1980,2015])
				.range([0,lgWidth - axesOffset]);
	// var yScale3pta = d3.scale.linear()
	// 				.domain()
	// 				.range([lgHeight,0]);
	
	var xAxis = d3.svg.axis()
	.scale(xScale)
	.ticks(30).tickFormat(d3.format(""))
	.orient("bottom");
	
	svg.append("g")
	.attr("class", "x axis")
	.attr("transform", "translate("+(axesOffset/2)+", " + (lgHeight - axesOffset/2)+ ")")
	.call(xAxis);
	
	
	// add the tooltip area to the webpage
	var tooltip = d3.select("body").append("div")
	    .attr("class", "tooltip")
	    .style("opacity", 0);
	    
	    
	var teams_data;
	var y3PercentScale;
	var y3AttemptScale;
	var y3PercentAxis;
	var y3AttemptAxis;
	var team_logos;
	d3.csv("p2sampledata.csv", function(error, data){
		teams_data = data;
		
		data.forEach(function(d){
			if(d.Year >= 1980){
				champYear.push(d.Year);
				champTeam.push(d.Team);
				threeAttempts.push(d.TPA);
				threePercent.push(d.TPP);
			}
		})
		
		y3PercentScale = d3.scale.linear()
			.domain([0, Math.max.apply(Math, threePercent)])
			.range([lgHeight - axesOffset, 0]);
		
		y3AttemptScale = d3.scale.linear()
			.domain([Math.min.apply(Math, threeAttempts), Math.max.apply(Math, threeAttempts)])
			.range([lgHeight -axesOffset, 0]);
		
		y3PercentAxis = d3.svg.axis()
		.scale(y3PercentScale)
		.ticks(10)
		.tickSize(lgWidth-axesOffset)
		.orient("right");
		
		y3AttemptAxis = d3.svg.axis()
		.scale(y3AttemptAxis)
		.ticks(10)
		.tickSize(lgWidth-axesOffset)
		.orient("right");
		
		svg.append("g")
		.attr("class", "y axis")
		.attr("transform", "translate("+axesOffset/2+", 50)")
		.call(y3PercentAxis);
		
		
		team_logos = svg.selectAll("team_logos").data(data)
		
		team_logos.enter().append("svg:image")
			.attr('x', function(d) { return xScale(d.Year) + axesOffset*2/5 })
			.attr('y', function(d) { return y3PercentScale(d.TPP) + axesOffset*2/5 })
			.attr("height", 34)
			.attr('width', 34)
			.attr('class', 'locale')
			.attr("xlink:href", function(d) { return "assets/img/" + d.Team + ".png" })
			.on("mouseover", function(d){
				//console.log(d3.event);
				tooltip.transition()
					.duration(1000)
					.style("opacity", 0.9)
					.style("background",nbaColors[d.Team]["first"])
					.style("color", nbaColors[d.Team]["second"]);
				//Year, Team, 3p%, 3pa, team age in hover
				// console.log(d3.event.pageX);
				// console.log(d3.event.pageY);
				//
				//console.log(d);
				//console.log(d3.select(d));
				//console.log(d3.select(d).attr("x"));
				tooltip.html("Year: "+d.Year+"<br/>"+"Team: "+d.Team+"<br/>"+"3P%: "+d.TPP+"<br/>"+"3PA: "+d.TPA+"<br/>"+"AvgAge: "+d.avgage)
					.style("left", (xScale(d.Year) + axesOffset*2/5+40) + "px")
					.style("height", "120px")			
                	.style("top", function() { 
                		if (isPercent) { 
                			return (y3PercentScale(d.TPP) + axesOffset*2/5) + "px";
                		} 
                		else { 
                			return (y3AttemptScale(d.TPA) + axesOffset*2/5) + "px"; 
                		}});
                })
            .on("mouseout", function(d) {
            	tooltip.transition()
            		.style("opacity",0);
            });	

			//});

	});
	
	var avg_points;
	function addLeagueAverage(){
		//If box is checked then add the league averages
		if(document.getElementById("leagueAvg").checked){

			
			d3.csv("average_3p_data.csv", function(error,data){
				// if(!loadedAvgs){
				// 	loadedAvgs = true;
				// 	data.forEach(function(d){
				// 		avgThreeAttempts.push(d.avgTPA);
				// 		avgThreePercent.push(d.avgTPP);
				// 		avgAge.push(d.Age);
				// 	});
				// }
			
				//Year, 3p%, 3pa, team age in hover
				//var avg_points = d3.selectAll(".avgs")[0];
				if(!loadedAvgs){
					loadedAvgs = true;
					avg_points = svg.selectAll("avgs").data(data);
				}

				if (document.getElementById("f-option").checked){
					//they're already on the screen
					if (svg.selectAll(".avgs")[0].length > 0) {
						avg_points.transition().duration(1500)
							.attr('cy', function(d) { return y3PercentScale(d.avgTPP) + axesOffset*1/2 });
					}
					else {
						//add em all new
						avg_points.enter().append("circle")
							.attr('cx', function(d) { return xScale(d.Year) + axesOffset*1/2 })
							.attr('cy', function(d) { return y3PercentScale(d.avgTPP) + axesOffset*1/2 })
							.attr("r", 5)
							.attr('class', 'avgs')
							.style("fill", "blue")
							.style("opacity", 0.7)
							.on("mouseover", function(d){
								tooltip.transition()
									.duration(200)
									.style("opacity", 0.9)
									.style("background","#009CFF")
									.style("color","#000")
								//Year, Team, 3p%, 3pa, team age in hover
								tooltip.html("Year: "+d.Year+"<br/>"+"Avg3P%: "+d.avgTPP+"<br/>"+"Avg3PA: "+d.avgTPA+"<br/>"+"AvgAge: "+d.Age)
									.style("left", (xScale(d.Year) + axesOffset*1/2+20) + "px")	
									.style("height", "120px")	
				                	.style("top", function () {
				                		if (isPercent) {
				                			return (y3PercentScale(d.avgTPP) + axesOffset*1/2) + "px"
				                		}
				                		else {
				                			return (y3AttemptScale(d.avgTPA) + axesOffset*1/2) + "px"
				                		}
				                	});
				                })
				            .on("mouseout", function(d) {
				            	tooltip.transition()
				            		.style("opacity",0);
				            });	
					}
				}
			
			//else do #3pa
				else {
					if (svg.selectAll(".avgs")[0].length > 0) {
						avg_points.transition().duration(1500)
							.attr('cy', function(d) { return y3AttemptScale(d.avgTPA) + axesOffset*1/2 });
					}
					else {
						avg_points.enter().append("circle")
							.attr('cx', function(d) { return xScale(d.Year) + axesOffset*1/2 })
							.attr('cy', function(d) { return y3AttemptScale(d.avgTPA) + axesOffset*1/2 })
							.attr("r", 5)
							.attr('class', 'avgs')
							.style("fill", "blue");
					}


				}
			});

		}
	//Box is unchecked
	else {
		svg.selectAll(".avgs").remove();
	}

}

	function updateData(category) {
		if(category == 'TPA'){
			isPercent = false;
		}
		else{
			isPercent = true;
		}
		//svg.selectAll(".locale").remove();
		d3.csv("p2sampledata.csv", function(error, data){
		
		 y3PercentScale = d3.scale.linear()
			.domain([0, Math.max.apply(Math, threePercent)])
			.range([lgHeight - axesOffset, 0]);
		
		 y3AttemptScale = d3.scale.linear()
			.domain([0, Math.max.apply(Math, threeAttempts)])
			.range([lgHeight -axesOffset, 0]);
		
		 y3PercentAxis = d3.svg.axis()
		.scale(y3PercentScale)
		.ticks(10).tickSize(lgWidth-axesOffset)
		.orient("right");
		 y3AttemptAxis = d3.svg.axis()
		.scale(y3AttemptScale)
		.ticks(10).tickSize(lgWidth-axesOffset)
		.orient("right");
		
		var threeData;
		var yScale;
		
		if(isPercent){
			svg.select(".y.axis").transition().duration(1500).call(y3PercentAxis);
			threeData = threePercent;
			yScale = y3PercentScale;
		}
		else{
			svg.select(".y.axis").transition().duration(1500).call(y3AttemptAxis);
			threeData = threeAttempts;
			yScale = y3AttemptScale;
		}
		
		d3.selectAll(".locale")[0].forEach(function(point,i) {
			d3.select(point).transition().duration(1500)
			.attr('y', yScale(threeData[i]) + axesOffset*2/5)
			});
		});
		
		if(document.getElementById("leagueAvg").checked){
			//svg.selectAll(".avgs").remove();
			addLeagueAverage();
		}
	}
</script>
<p>
	
</p>
<div id="shot-chart-page">
    <style type="text/css">
        .shot-chart-court *{
            fill:transparent;
            stroke:#333;
            stroke-width:0.1
        }
        .shot-chart-court-ft-circle-bottom{
            stroke-dasharray:1.5, 1
        }
        .shot-chart-court-hoop,.shot-chart-court-backboard{
            z-index:1;
        }
        .shot-chart-title{
            font-size:15%;
            text-transform:uppercase
        }
        .legend text{
            font-size:4%
        }
        circle {
            z-index: -100;
        }
	svg {
	    background: transparent;
	}
        
	#circle0 {
	    stroke-width: 4px;
	}
	#circle1 {
	    stroke-width: 52px;
	}
	#circle2 {
	    stroke-width: 52px;
	}
	#circle3 {
	    stroke-width: 52px;
	}
	#circle4 {
	    stroke-width: 52px;
	}
	
    </style>
    <div id='top-wrapper'></div>
    
    <div id="chart1">
        <h3>% of shots taken by range</h3>
        <svg class='shot-chart-1'></svg>
    </div>
<script>
    
    var nbaChampString=[];
    
    $( document ).ready(function() {
	d3.csv("p2sampledata.csv", function(error, data){
	    data.forEach(function(d){
		nbaChampString.push(d.Year+" "+d.Team);
	    });
	    
	    var countChamps = 0;
	    $("#top-wrapper").append("<select id='shot-chart-select' onchange='setYear()'></select>");
	    for (var value=2015; value>=1980;value--){
		    $("#shot-chart-select").append("<option value='"+value+"'>"+nbaChampString[countChamps]+"</option>");
		    //console.log(nbaChampString[countChamps]);
		    countChamps++;
	    }
	    
	    setYear();
	
	});
    });
    
    function setYear() {
	var inputYear = $("#shot-chart-select").val();
	updateChart(inputYear);
    }
    
    //court drawing from http://jsfiddle.net/ramnathv/p6z74yv0/
    var svgShotChart = d3.select(".shot-chart-1");
    opts = {
    // basketball hoop diameter (ft)
    basketDiameter: 1.5,
    // distance from baseline to backboard (ft)
    basketProtrusionLength: 4,
    // backboard width (ft)
    basketWidth: 6,
    // title of hexagon color legend
    colorLegendTitle: 'Efficiency',
    // label for starting of hexagon color range
    colorLegendStartLabel: '< avg',
    // label for ending of hexagon color range
    colorLegendEndLabel: '> avg',
    // full length of basketball court (ft)
    courtLength: 94,
    // full width of basketball court (ft)
    courtWidth: 50,
    // distance from baseline to free throw line (ft)
    freeThrowLineLength: 19,
    // radius of free throw line circle (ft)
    freeThrowCircleRadius: 6,
    // d3 scale for hexagon colors
    heatScale: d3.scale.quantize()
      .domain([0, 1])
      .range(['#5458A2', '#6689BB', '#FADC97', '#F08460', '#B02B48']),
    // height of svg
    height: 375,
    // method of aggregating points into a bin
    hexagonBin: function (point, bin) {
      var attempts = point.attempts || 1;
      var made = +point.made || 0;
      bin.attempts = (bin.attempts || 0) + attempts;
      bin.made = (bin.made || 0) + made;
    },
    // how many points does a bin need to be visualized
    hexagonBinVisibleThreshold: 1,
    
    // method to determine value to be used with specified heatScale
    hexagonFillValue: function(d) {  return d.made/d.attempts; },
    
    // bin size with regards to courth width/height (ft)
    hexagonRadius: .75,
    
    // discrete hexagon size values that radius value is mapped to
    hexagonRadiusSizes: [0, .4, .6, .75],
    
    // how many points in a bin to consider it while building radius scale
    hexagonRadiusThreshold: 2,
    
    // method to determine radius value to be used in radius scale
    hexagonRadiusValue: function (d) { return d.attempts; },
    
    // width of key marks (dashes on side of the paint) (ft)
    keyMarkWidth: .5,
    
    // width the key (paint) (ft)
    keyWidth: 16,
    
    // radius of restricted circle (ft)
    restrictedCircleRadius: 4,
    
    // title of hexagon size legend
    sizeLegendTitle: 'Frequency',
    
    // label of start of hexagon size legend
    sizeLegendSmallLabel: 'low',
    
    // label of end of hexagon size legend
    sizeLegendLargeLabel: 'high',
    
    // distance from baseline where three point line because circular (ft)
    threePointCutoffLength: 14,
    
    // distance of three point line from basket (ft)
    threePointRadius: 23.75,
    
    // distance of corner three point line from basket (ft)
    threePointSideRadius: 22, 
    
    // title of chart
    title: 'Shot chart',
    
    // method to determine x position of a bin on the court
    translateX: function (d) { return d.x; },
    
    // method to determine y position of a bin on the court
    translateY: function (d) { return this._visibleCourtLength - d.y; },
    
    // width of svg
    width: 500
    }
    
    var o = opts
    
    calculateVisibleCourtLength = function () {
          var halfCourtLength = o.courtLength / 2;
          var threePointLength = o.threePointRadius + 
            o.basketProtrusionLength;
          o.visibleCourtLength = threePointLength + 
            (halfCourtLength - threePointLength) / 2;
    }
    
    calculateVisibleCourtLength();
    
    // helper to create an arc path
    appendArcPath = function (base, radius, startAngle, endAngle) {
          var points = 30;
    
          var angle = d3.scale.linear()
              .domain([0, points - 1])
              .range([startAngle, endAngle]);
    
          var line = d3.svg.line.radial()
              .interpolate("basis")
              .tension(0)
              .radius(radius)
              .angle(function(d, i) { return angle(i); });
    
          return base.append("path").datum(d3.range(points))
              .attr("d", line);
    }
    
    // draw basketball court
    var drawCourt = function (id) {
          var base = d3.select(id)
            .attr('width', o.width)
            .attr('height', o.height)
            .append('g')
              .attr('class', 'shot-chart-court')
              .attr('transform','scale(10,10)');
                           
          base.append("rect")
            .attr('class', 'shot-chart-court-key')
            .attr("x", (o.courtWidth / 2 - o.keyWidth / 2))
            .attr("y", (o.visibleCourtLength - o.freeThrowLineLength))
            .attr("width", o.keyWidth)
            .attr("height", o.freeThrowLineLength);
    
          base.append("line")
            .attr('class', 'shot-chart-court-baseline')
            .attr("x1", 0)
            .attr("y1", o.visibleCourtLength)
            .attr("x2", o.courtWidth)
            .attr("y2", o.visibleCourtLength);
                  
          var tpAngle = Math.atan(o.threePointSideRadius / 
            (o.threePointCutoffLength - o.basketProtrusionLength - o.basketDiameter/2));
          appendArcPath(base, o.threePointRadius, -1 * tpAngle, tpAngle)
            .attr('class', 'shot-chart-court-3pt-line')
            .attr("transform", "translate(" + (o.courtWidth / 2) + ", " + 
              (o.visibleCourtLength - o.basketProtrusionLength - o.basketDiameter / 2) + 
              ")");
             
          [1, -1].forEach(function (n) {
            base.append("line")
              .attr('class', 'shot-chart-court-3pt-line')
              .attr("x1", o.courtWidth / 2 + o.threePointSideRadius * n)
              .attr("y1", o.visibleCourtLength - o.threePointCutoffLength)
              .attr("x2", o.courtWidth / 2 + o.threePointSideRadius * n)
              .attr("y2", o.visibleCourtLength);
          });
            
          appendArcPath(base, o.restrictedCircleRadius, -1 * Math.PI/2, Math.PI/2)
            .attr('class', 'shot-chart-court-restricted-area')
            .attr("transform", "translate(" + (o.courtWidth / 2) + ", " + 
              (o.visibleCourtLength - o.basketProtrusionLength - o.basketDiameter / 2) + ")");
                                                             
          appendArcPath(base, o.freeThrowCircleRadius, -1 * Math.PI/2, Math.PI/2)
            .attr('class', 'shot-chart-court-ft-circle-top')
            .attr("transform", "translate(" + (o.courtWidth / 2) + ", " + 
              (o.visibleCourtLength - o.freeThrowLineLength) + ")");
                                                              
          appendArcPath(base, o.freeThrowCircleRadius, Math.PI/2, 1.5 * Math.PI)
            .attr('class', 'shot-chart-court-ft-circle-bottom')
            .attr("transform", "translate(" + (o.courtWidth / 2) + ", " + 
              (o.visibleCourtLength - o.freeThrowLineLength) + ")");
    
          [7, 8, 11, 14].forEach(function (mark) {
            [1, -1].forEach(function (n) {
              base.append("line")
                .attr('class', 'shot-chart-court-key-mark')
                .attr("x1", o.courtWidth / 2 + o.keyWidth / 2 * n + o.keyMarkWidth * n)
                .attr("y1", o.visibleCourtLength - mark)
                .attr("x2", o.courtWidth / 2 + o.keyWidth / 2 * n)
                .attr("y2", o.visibleCourtLength - mark)
            });
          });    
    
          base.append("line")
            .attr('class', 'shot-chart-court-backboard')
            .attr("x1", o.courtWidth / 2 - o.basketWidth / 2)
            .attr("y1", o.visibleCourtLength - o.basketProtrusionLength)
            .attr("x2", o.courtWidth / 2 + o.basketWidth / 2)
            .attr("y2", o.visibleCourtLength - o.basketProtrusionLength)
                                         
          base.append("circle")
            .attr('class', 'shot-chart-court-hoop')
            .attr("cx", o.courtWidth / 2)
            .attr("cy", o.visibleCourtLength - o.basketProtrusionLength - o.basketDiameter / 2)
            .attr("r", o.basketDiameter / 2)
    }
    
    drawCourt(".shot-chart-1");
    drawCourt(".shot-chart-2");

    var xScaleCourt = d3.scale.linear()
        .domain([-16,16])
        .range([0,o.width]);
    
    var yScaleCourt = d3.scale.linear()
        .domain([0,35])
        .range([o.height,0]);
    
    var colorScale = d3.scale.linear()
            //.domain([Math.log(.3), Math.log(.7)])
            .domain([.1,.3])
            .range(['#1569CC','#FF1701']);
            
    var colorScaleFG = d3.scale.linear()
            .domain([0.2,0.7])
            .range(['#1569CC','#FF1701']);
    
    function updateChart(yr){
	
    d3.csv("p2sampledata.csv", function(error, data){
        
	var distances = [10,13,18.40,23.8,29.2];
	
	$(".shot-chart-data").empty();
        data.forEach(function(d){
	    
	    if (yr>2000) {
		
                if(d.Year == yr){
                    
                    var teamShotsFGP = [d["fgpct0-3"],d["fgpct3-10"],d["fgpct10-16"],d["fgpct16<3"],d["fgpct3"]];
                    var teamShots = [d['pctoffg0-3'],d['pctoffg3-10'],d['pctoffg10-16'],d['pctoffg16<3'],d['pctoffg3']];
                    
                    for (var i=4;i>=0;i--){
                        d3.select(".shot-chart-1").append('g').attr("class","shot-chart-data").append("ellipse")
                        .attr("cx", xScaleCourt(0))
                        .attr("cy", yScaleCourt(1)-27)
                        .attr("rx", 10*distances[i] - 25)
			.attr("ry", 10*distances[i] - 16)
			.attr("id","circle"+i)
			.style("opacity",0.5)
			.style("fill", function() {
				if (i==0) {
				    return colorScale(teamShots[0]);
				}
				else{
				    return "none";
				}
			    })
			.style("stroke",function() {
                            //console.log(" "+i+ ": "+teamShots[i]+", color: "+colorScale(teamShots[i]));
                            //console.log(Math.log(teamShots[i]));
                            //return colorScale(Math.log(teamShots[i]));
                            return colorScale(teamShots[i]);
                        });
                        
			
			//text ----------
                        d3.select(".shot-chart-1").append("text")
			.text((teamShots[i]*100).toFixed(2)  + "%").attr("class","shot-chart-data")
                        .attr("x", xScaleCourt(0))
                        .attr("y", yScaleCourt(i*6+5))
                        .attr("text-anchor","middle");
                    }
		    
		    //cheating on the styling to make it work left side
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(-16.7))
		    .attr("y",yScaleCourt(13.5))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill","white");
		    
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(-16.7))
		    .attr("y",yScaleCourt(13.51))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill",colorScale(teamShots[4]))
		    .style("opacity",0.5);
		    
		    //cheating on the styling to make it work right side
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(14.17))
		    .attr("y", yScaleCourt(13.5))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill","white");
		    
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(14.17))
		    .attr("y",yScaleCourt(13.5))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill",colorScale(teamShots[4]))
		    .style("opacity",0.5);
                }
	    }
	    else {
		
		if(d.Year == yr){
		    
		    var totalShots = Number(d["O2PA"])+Number(d["O3PA"]);
                    var teamShots = [Number(d["O2PA"])/totalShots, Number(d["O3PA"])/totalShots];
			
			//inside 3pt line
                        d3.select(".shot-chart-1").append('g').attr("class","shot-chart-data").append("ellipse")
                        .attr("cx", xScaleCourt(0))
                        .attr("cy", yScaleCourt(1)-27)
                        .attr("rx", 10*distances[3] - 25)
			.attr("ry", 10*distances[3] - 16)
			.attr("id","circle"+0)
			.style("opacity",0.5)
			.style("fill", colorScale(teamShots[0]))
			.style("stroke",colorScale(teamShots[0]))
			.style("stroke-width",50);
			//text ----------
                        d3.select(".shot-chart-1").append("text")
			.text((teamShots[0]*100).toFixed(2)  + "%").attr("class","shot-chart-data")
                        .attr("x", xScaleCourt(0))
                        .attr("y", yScaleCourt(15))
                        .attr("text-anchor","middle");
			
			//outside 3pt line
			d3.select(".shot-chart-1").append('g').attr("class","shot-chart-data").append("ellipse")
                        .attr("cx", xScaleCourt(0))
                        .attr("cy", yScaleCourt(1)-27)
                        .attr("rx", 10*distances[4] - 25)
			.attr("ry", 10*distances[4] - 16)
			.attr("id","circle"+4)
			.style("opacity",0.5)
			.style("fill", "none")
			.style("stroke",colorScale(teamShots[1]));
			//text ----------
                        d3.select(".shot-chart-1").append("text")
			.text((teamShots[1]*100).toFixed(2)  + "%").attr("class","shot-chart-data")
                        .attr("x", xScaleCourt(0))
                        .attr("y", yScaleCourt(28))
                        .attr("text-anchor","middle");
		    
		    //cheating on the styling to make it work left side
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(-16.7))
		    .attr("y",yScaleCourt(13.5))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill","white");
		    
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(-16.7))
		    .attr("y",yScaleCourt(13.51))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill", colorScale(teamShots[1]))
		    .style("opacity",0.5);
		    
		    //cheating on the styling to make it work right side
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(14.17))
		    .attr("y", yScaleCourt(13.5))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill","white");
		    
		    d3.select(".shot-chart-1").append("rect")
		    .attr("x", xScaleCourt(14.17))
		    .attr("y",yScaleCourt(13.5))
		    .attr("width",40)
		    .attr("height",180)
		    .style("fill",colorScale(teamShots[1]))
		    .style("opacity",0.5);
                }
		
		
	    }
        });
        
        
    });
    
    }    
</script>
</div>


<style>
/* put a border around the svg element so we can see the coordinate system better. */
body { font-family: "Open Sans"; }

div {margin: 0;}

#main-content-wrapper {
	width: 1200px;
	margin: auto;
}

#playerCards-wrapper-left {
	display: inline-block;
	width: 45%;
	margin: 8px;
}

/*the dropdown menu styling*/
select {
	width: 470px;
	font-size: 34px;
}

.card {
	border: solid grey 2px;
	border-color: inherit;
	margin: 8px 0px 8px 0px;
	width: 450px;
	padding: 8px;
}
.card:hover {
	cursor: pointer;
	border-color: yellow;
	transition-duration: 0.75s;
}
.player-stats{
	margin-top: 3em;
}
.stats {
	margin-left: 12px;
	font-size: 15px;
	text-align: center;
}
table {
	border-collapse: collapse;
}

table, th, td {
	border: black solid 1px;
}
.stats td, .stats th{
	padding: 8px;
	color: #aaa;
}
img {
	z-index: -2;
	width: 140px;
}
.player-photo {
	position: absolute;
	margin-left: 20px;
	text-align: center;
}
.player-bio{
	margin-left: 180px;
}
.lbs {
	font-size: small;
}
	
.card h1 {
	display: inline-block;
	font-size: 26px}
.card ul {
	font-size: 16px;
	list-style: none;
	margin-top: -14px;
}
.card p {
	margin-left: 20px;
}
.position {
	margin-left: 14px;
	
}

.last {
	font-size: 20px;
}


/*right side players*/
#playerCards-wrapper-right {
	display: inline-block;
	position: absolute;
	width: 45%;
	margin: 8px;
	
}

/*back of the card*/
.back {
	display: none;
	overflow: hidden;
}

.back .team-logo {
	opacity: 0.065;
}
.back .position {
	margin-top: -1em;
}
.back img {
	position: absolute;
	width: 200px;
	margin-left: 225px;
}

.career-stats{
	margin-top: -.5em;
	
}

</style>
</head>
<body>

<div id="main-content-wrapper">
<div id="playerCards-wrapper-left"></div>
<div id="playerCards-wrapper-right"></div>
</div>
<script>

var nbaColors = {"Atlanta Hawks": {"first": "#01244C", "second": "#D21033"},
 "Boston Celtics": {"first": "#05854C", "second": "#EAEFE9",  "third": "#FFFFFF"},
 "Charlotte Bobcats": {"first": "#F26532" , "second":  "#29588B" },
 "Chicago Bulls": {"first": "#D4001F", "second": "#000000", "third":"#FFFFFF"},
"Cleveland Cavaliers":{"first":"#9F1425","second":"#003375", "third":"#B99D6A"},
 "Dallas Mavericks": {"first": "#006AB5", "second": "#F0F4F7"}, 
"Denver Nuggets": {"first":  "#4393D1", "second": "#FBB529"},
"Detroit Pistons": {"first":"#ED174C", "second":"#006BB6"},
"Golden State Warriors": {"first": "#FDB927", "second": "#006bb6", "third": "#FFC33C"},
"Houston Rockets": {"first":"#CC0000", "second":"#FFFFFF"},
"Indiana Pacers": {"first": "#002E62",  "second":"#FFC225"},
"Los Angeles Clippers": {"first":"#EE2944", "second": "#146AA2", "third": "#FFFFFF" },
"Los Angeles Lakers": {"first":"#4A2583", "second":"#F5AF1B"},
"Memphis Grizzlies": {"first": "#001B41", "second":"#85A2C6", "third":"#FFFFFF"},
"Miami Heat": {"first":  "#B62630", "second":"#1E3344","third": "#FF9F00"},
"Milwaukee Bucks": {"first": "#00330A", "second": "#C82A39"},
"Minnesota Timberwolves": {"first": "#015287", "second": "#000000", "third": "#EFEFEF"},
"New Jersey Nets": {"first":"#002258", "second":"#D32E4C", "third":"#EFEFF1"},
"New Orleans Hornets": {"first":  "#0095CA", "second": "#1D1060", "third": "#FEBB25"},
"New York Knicks": {"first":"#2E66B2", "second":"#FF5C2B" },
"Oklahoma City Thunder": {"first": "#0075C1", "second":"#E7442A","third":"#002553"},
"Orlando Magic": {"first": "#077ABD","second":"#C5CED5","third":"#000000"},
"Philadelphia 76ers": {"first": "#C5003D", "second": "#000000", "third": "#C7974D" },
"Phoenix Suns": {"first": "#48286C", "second":"#FF7A31","third": "#FFBC1E" },
"Portland Trail Blazers": {"first": "#000000", "second": "#E1393E", "third": "#B4BDC3" },
"San Antonio Spurs": {"first": "#000000", "second": "#BEC8C9", "thrid": "#FFFFFF" },
"Sacramento Kings": {"first": "#743389", "second":"#DCE2E4", "thrid": "#000000"},
"Toronto Raptors": {"first":"#CD1041", "second":"#ECEBE9", "third":"#000000"},
"Utah Jazz": {"first":"#001D4D","second":"#448CCE",  "third":"#480975"},
"Washington Wizards": {"first":"#004874","second":"#BC9B6A" }}

$( document ).ready(function() {
	
	
	$("#playerCards-wrapper-left").append("<select id='years1' onchange='createTeamCards(1)'></select><div id='playerCards1'></div>");
	$("#playerCards-wrapper-right").append("<select id='years2' onchange='createTeamCards(2)'></select><div id='playerCards2'></div>");
	for (var value=2015; value>1979;value--){
		$("#years1").append("<option value='"+value+"'>"+(value-1)+" - "+value+"</option>");
		$("#years2").append("<option value='"+value+"'>"+(value-1)+" - "+value+"</option>");
	}
	$("#years1").val(1996);
	createTeamCards(1);
	createTeamCards(2);
});

var Year;
//get the 5 players from the csv file and then create cards for them
function createTeamCards(leftOrRight){
	var inputYear = $("#years"+leftOrRight).val();
	Year = inputYear-1 +"-"+inputYear;
	d3.csv("championship_players_data.csv", function (error, rows) {	
		if (error) {console.log(error);}
		playersStats = d3.map(rows, function (player) { return player.Player; });
		//console.log(rows);
		$("#playerCards"+leftOrRight).empty();
		var teamList;
		for (var i=0; i<rows.length; i++){
			if (rows[i].Year == inputYear) {
				//console.log(rows[i])
				createCard(rows[i], leftOrRight);
			}
		}
	});
}

function draftIdea(player) {
	var drafted = "";
	
	d3.csv("lottery_picks_data.csv", function (error, rows) {	
		if (error) {console.log(error);}
		
		playersStats = d3.map(rows, function (year) { return year.Year; });
		//console.log(rows);
		for (var i=0; i<rows.length; i++){
			//console.log(rows[i]);
			//console.log(player.Draft_Year);
			if (rows[i].Year == player.Draft_Year) {
				
				if (player.Player == rows[i].P1) {
					drafted =  " was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the first overall pick.";
				}
				if (player.Player == rows[i].P2) {
					drafted =  " was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the second overall pick.";
				}
				if (player.Player == rows[i].P3) {
					drafted =  " was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the third overall pick.";
				}
				if (player.Player == rows[i].P4) {
					drafted =  " was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the fourth overall pick.";
				}
				if (player.Player == rows[i].P5) {
					drafted =  " was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the fifth overall pick.";
				}
				if (player.Player == rows[i].P6) {
					drafted =  " was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the sixth overall pick.";
				}
				if (player.Player == rows[i].P7) {
					//console.log(" was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the seventh overall pick.");
					drafted =  " was drafted in "+player.Draft_Year+" by the" + rows[i].P1Team+" with the seventh overall pick.";
				}
				else {
					drafted =  " was drafted in "+player.Draft_Year+"by the"+ rows[i].P1Team+".";
				}
			}
			
		}
	});
	
	return drafted;
}

//creating cards for the players.
function createCard(player, leftorRight){
	//console.log(player);
	$("#playerCards"+leftorRight).append("<div class='card' id="+player.id+leftorRight+" onclick='flip("+player.id+leftorRight+")'> </div>");
	$("#"+player.id+leftorRight).append("<div class='card-wrapper'> <div class='card-content'> <div class='player-photo'>  <img src='assets/img/"+player.picture_url+"' alt='"+player.Player+" Photo'></div><div class='player-bio'> <h1><span class='playerNumber"+leftorRight+"'>#"+player.Number+" </span>"+player.Player+"</h1><ul class='general-info'> <li class='first'>"+player.Height+", "+player.Weight+"<span class='lbs'>lbs</span> <span class='position'>"+player.Position+"</span></li> <li class='last'>"+player.Team+"</li></ul></div> <div class='player-stats'> <p class='yearPlaying'>"+Year+" Season</p> <table class='stats'><thead><tr><th>MPG</th><th>PPG</th><th>APG</th><th>RPG</th><th>SPG</th><th>3P%</th><th>3PA</th><th>WS</th></tr></thead> <tbody> <tr><td>"+player.MP+"</td><td>"+player.PTS+"</td><td>"+player.ast+"</td><td>"+player.TRB+"</td><td>"+player.stl+"</td><td>"+(player['p3%']*100).toFixed(1)+"%</td><td>"+player['p3A']+"</td><td>"+player.WS+"</td></tr></tbody></table></div></div></div>");
	
	//the player vs the position average that year
	var fg = "??";
	
	//this doesnt work yet
	draftMe = draftIdea(player);
	var draftMe = " was drafted in "+player.Draft_Year;
	
	
	$("#"+player.id+leftorRight).append("<div class='back' id=back"+player.id+leftorRight+"><div class='card-wrapper'> <div class='team-logo'><img src='assets/img/"+player.Team+".png' alt='Team Logo'></div><div class='card-content'> <h1><span class='playerNumber"+leftorRight+"'>#"+player.Number+" </span>"+player.Player+"</h1><br><span class='position'>"+player.Position+"</span> "+player.Team+"<br><p class='draftYear'>"+player.Player+" "+draftMe+".</p> <div class='career-stats' id=st"+player.id+"> <p class='careerPlaying'>Career Stats</p> <table class='stats'><thead><tr><th>MPG</th><th>PPG</th><th>APG</th><th>RPG</th><th>SPG</th><th>3%</th><th>3A</th><th>FG%</th></tr></thead> <tbody> <tr><td>"+player.career_MP+"</td><td>"+player.career_PTS+"</td><td>"+player.career_ast+"</td><td>"+player.career_TRB+"</td><td>"+player.career_stl+"</td><td>"+(player['career_3p%']*100).toFixed(1)+"%</td><td>"+player['career_3pA']+"</td><td>"+ fg +"</td></tr></tbody></table></div></div></div></div>");
	var teamColors;
	//console.log(player.Team);
	/*for (var k=0; k<nbaColors.length; k++){
		//console.log(nbaColors[k].team);
		if (nbaColors[k].team == player.Team) {
			teamColors = nbaColors[k];
			$("#"+player.id+leftorRight).css("color", teamColors.second);
			$(".position"+leftorRight).css("color", teamColors.first);
			$(".playerNumber"+leftorRight).css("color", teamColors.first);
			if (teamColors.team == "Houston Rockets" || teamColors.team == "Boston Celtics"
			    || teamColors.team == "Dallas Mavericks") {
				$("#"+player.id+leftorRight).css("color","#aaa");
			}
			$(".position").css("color", teamColors.first);
			$("#st"+player.id).css("color", teamColors.first).css("font-size",20);
		}
	}*/
	
	teamColors = nbaColors[player.Team];
	//console.log(teamColors);
	$("#"+player.id+leftorRight).css("color", teamColors.second);
	$(".position"+leftorRight).css("color", teamColors.first);
	$(".playerNumber"+leftorRight).css("color", teamColors.first);
	if (player.Team == "Houston Rockets" || player.team == "Boston Celtics"
	    || player.Team == "Dallas Mavericks") {
		$("#"+player.id+leftorRight).css("color","#aaa");
	}
	$(".position").css("color", teamColors.first);
	$("#st"+player.id).css("color", teamColors.first).css("font-size",20);
	
	
}

//career_ast	career_stl	career_blk	career_TRB	career_3p%	career_3pA	career_2p%	career_2pA	career_PTS	career_MP

//flip to the back of the card
function flip(divID) {
	
	var height = $("#"+divID).height();
	$("#"+divID).height(height);
	
	if ($("#"+divID).children(":first").is(":visible") ) {
		
		$("#"+divID).children(":first").fadeToggle(300, function() {
			$("#"+divID).children(":nth-child(2)").fadeToggle();
		});
	}
	else {
		$("#"+divID).children(":nth-child(2)").fadeToggle(300, function() {
			$("#"+divID).children(":first").fadeToggle();
		});
	}
}

</script>

<style>
    /*style the horseRace graph*/
    #horseRaceSVG {
	margin-top: .1em;
    }
    
    #top-level {
	text-align: center;
    }
    #top-level button {
	padding:5px;
	font-size: large;
	border-radius: 5px;
    }
    
</style>
<div id="horseRace">
    <div id="top-level">
	<select id="raceYear" onchange="createXAxis();lockoutSubmit()">
		
	</select>
	<button type="button" onClick="moveHorse();lockoutSubmit()" id="moveHorse">Play Next Year</button>
    </div>
</div>
<script type="text/javascript">
	var lotteryPicks;
	var yr;
	var shouldAddHorses = true;
	var canPlayHorses = false;
	var yrOffset = 0;
	var xScaleYears;
	//Creating SVG
	var svgHR = d3.select("#horseRace").append("svg").attr("id","horseRaceSVG")
	.attr("width", lgWidth)
	.attr("height", lgHeight);
	//Looping through the years and adding the years to run the race on.
	var raceyr = document.getElementById("raceYear");
	//Adding Select year option
	var topFiller = document.createElement("option")
	topFiller.text = "---Select Year---"
	raceyr.add(topFiller);
	for(i = 2014; i>=1985; i--){
		var option = document.createElement("option");
		option.text = i;
		raceyr.add(option);
	}
	//Adding the Y axis which doesn't change regardless of the year
	var yWins = d3.scale.linear()
		.domain([0, 83])
		.range([lgHeight - axesOffset, 0]);
	var yWinsAxis = d3.svg.axis()
	.scale(yWins)
	.ticks(20)
	.tickSize(lgWidth-axesOffset)
	.orient("right");
	svgHR.append("g")
	.attr("class", "y axis")
	.attr("transform", "translate("+axesOffset/2+", 50)")
	.call(yWinsAxis);
	function createXAxis(){
		lotteryPicks=[]
		svgHR.selectAll(".trophy").remove();

		svgHR.select(".x.axis").remove();
		svgHR.selectAll(".line").remove();
		canPlayHorses = false;
		yrOffset =0;
		 yr = document.getElementById("raceYear").value;
		if(!isNaN(yr)){
			//Need to move points back to origin 
			canPlayHorses = true;
			xScaleYears = d3.scale.linear()
			.domain([yr,2014])
			.range([0,lgWidth - axesOffset]);
			var xAxisYears = d3.svg.axis()
			.scale(xScaleYears)
			.ticks(2015-yr).tickFormat(d3.format(""))
			.orient("bottom");
			svgHR.append("g")
			.attr("class", "x axis")
			.attr("transform", "translate("+(axesOffset/2)+", " + (lgHeight - axesOffset/2)+ ")")
			.call(xAxisYears);
			d3.json("lottery_picks_stats_data.json", function(error,data){
				//2014-year = start index for first player
				var dataIndexStart = (2014-yr)*7;
				var dataIndexEnd = dataIndexStart+6;

				//var raceYearObject = data[dataIndex];
				lotteryPicks = data[yr];
				//var xax = "Player"
				//console.log(lotteryPicks[0][xax])
				if(shouldAddHorses){

				lotteryPicks.forEach(function(d){
var playersTeam = d["stats"][yrOffset]["team"];
					//Go into the NBAteam.json and get their color

					var playerTeamColor = nbaColorsAbbreviated[playersTeam]["first"];
					svgHR.append("circle")
					.attr('cx', xScaleYears(yr) + axesOffset*1/2)
					.attr('cy', yWins(0) + axesOffset*1/2)
					.attr("r", 4)
					.attr('class', 'horses')
					.on("mouseover",function(j){
						console.log(j);
						tooltip.transition()
						.duration(200)
						.style("opacity", 0.9)
						.style("background",playerTeamColor)
						.style("color", nbaColorsAbbreviated[playersTeam]["second"]);
					//Year, Team, 3p%, 3pa, team age in hover
					tooltip.html(d.name+"<br/>"+"Wins: "+d.stats[yrOffset]["wins"]+"<br/>"
						+"Year in League: " + yrOffset)
						.style("left", (d3.event.pageX + 20) + "px")	
						.style("height", "65px")	
		            	.style("top", (d3.event.pageY) + "px");
						})
					.on("mouseout", function(d) {
		            	tooltip.transition()
		            	.style("opacity",0);
		            })
					.style("fill", "black");
				});
				shouldAddHorses = false;
				}
				else{
					d3.selectAll(".horses")[0].forEach(function(point,i) {
						d3.select(point).transition().duration(1500)
						.attr('cx', xScaleYears(yr) + axesOffset*1/2)
						.attr('cy', yWins(0) + axesOffset*1/2);
						});
					setTimeout(function(){
						svgHR.selectAll(".horses").remove();
					lotteryPicks.forEach(function(d){
var playersTeam = d["stats"][yrOffset]["team"];
					//Go into the NBAteam.json and get their color

					var playerTeamColor = nbaColorsAbbreviated[playersTeam]["first"];
					svgHR.append("circle")
					.attr('cx', xScaleYears(yr) + axesOffset*1/2)
					.attr('cy', yWins(0) + axesOffset*1/2)
					.attr("r", 4)
					.attr('class', 'horses')
					.on("mouseover",function(j){
						console.log(j);
						tooltip.transition()
						.duration(200)
						.style("opacity", 0.9)
						.style("background",playerTeamColor)
						.style("color", nbaColorsAbbreviated[playersTeam]["second"]);
					//Year, Team, 3p%, 3pa, team age in hover
					tooltip.html(d.name+"<br/>"+"Wins: "+d.stats[yrOffset]["wins"]+"<br/>"
						+"Year in League: " + yrOffset)
						.style("left", (d3.event.pageX + 20) + "px")	
						.style("height", "65px")	
		            	.style("top", (d3.event.pageY) + "px");
						})
					.on("mouseout", function(d) {
		            	tooltip.transition()
		            	.style("opacity",0);
		            })
					.style("fill", "black");
				});
					},1500);
					
				shouldAddHorses = false;
				}

				
			});


		}
		else{
			svgHR.selectAll(".horses").remove();
			svgHR.selectAll(".line").remove();
			svgHR.selectAll(".trophy").remove();
			shouldAddHorses = true;
		}
	}
	function moveHorse(){
		if(canPlayHorses && yr <2015){
			d3.selectAll(".horses")[0].forEach(function(point,i) {
				var selected_point = d3.select(point);
				if((lotteryPicks[i]["stats"][yrOffset] !== undefined) && (lotteryPicks[i]["stats"][yrOffset]['year'] == yr)){
					//line transition idea from http://jaketrent.com/post/animating-d3-line/

					//Get team line color
					//gets the team
					var playersTeam = lotteryPicks[i]["stats"][yrOffset]["team"];
					//Go into the NBAteam.json and get their color
					console.log(playersTeam)
					var playerTeamColor = nbaColorsAbbreviated[playersTeam]["first"];
					
					svgHR.append('line')
					.attr('class','line')
					.attr('x1',selected_point.attr("cx"))
					.attr('y1',selected_point.attr("cy"))
					.attr('x2',selected_point.attr("cx"))
					.attr('y2',selected_point.attr("cy"))
					.transition()
					.duration(1500)
					.attr('x2',xScaleYears(yr) + axesOffset*1/2)
					.attr('y2',yWins(lotteryPicks[i]["stats"][yrOffset]['wins']) + axesOffset*2/5)
					.attr('stroke',playerTeamColor);

					selected_point.transition().duration(1500)
					.attr('cx', xScaleYears(yr) + axesOffset*1/2)
					.attr('cy', yWins(lotteryPicks[i]["stats"][yrOffset]['wins']) + axesOffset*2/5);
					if (yrOffset == 0) {
						svgHR.selectAll(".line").remove()
					}

					if(nbaTeamChamp[yr] == playersTeam){
					var displayYear = []
					displayYear.push(yr);
					var displayWins = []
					displayWins.push(lotteryPicks[i]["stats"][yrOffset]['wins'])
					svgHR.append("svg:image")
					.attr('x', xScaleYears(yr) + axesOffset*2/5)
					.attr('y', yWins(lotteryPicks[i]["stats"][yrOffset]['wins']) + axesOffset*3/10)
					.attr("height", 25)
					.attr('width', 25)
					.attr("text-anchor","middle")
					.attr('class', 'trophy')
					.attr("xlink:href", "assets/img/nbatrophy.png")
					.on("mouseover", function(d){

						tooltip.transition()
						.duration(200)
						.style("opacity", 0.9)
						.style("background",playerTeamColor)
						.style("color", nbaColorsAbbreviated[playersTeam]["second"]);
					//Year, Team, 3p%, 3pa, team age in hover
					tooltip.html("Year: "+displayYear[0]+"<br/>"+"Team: "+playersTeam+"<br/>"+"Wins: "+displayWins[0])
						.style("left", (d3.event.pageX) + "px")		
		            	.style("top", (d3.event.pageY) + "px");
						})
					.on("mouseout", function(d) {
		            	tooltip.transition()
		            	.style("opacity",0);
		            });	
					}


				}
			//
				else if(lotteryPicks[i]["stats"][yrOffset] !== undefined){
					for (j=yrOffset; j>=0; j--){
						if(lotteryPicks[i]["stats"][j]['year'] == yr){
							//line transition idea from http://jaketrent.com/post/animating-d3-line/

							svgHR.append('line')
							.attr('class','line')
							.attr('x1',selected_point.attr("cx"))
							.attr('y1',selected_point.attr("cy"))
							.attr('x2',selected_point.attr("cx"))
							.attr('y2',selected_point.attr("cy"))
							.transition()
							.duration(1500)
							.attr('x2',xScaleYears(yr) + axesOffset*1/2)
							.attr('y2',yWins(lotteryPicks[i]["stats"][j]['wins']) + axesOffset*2/5)
							.attr('stroke',"#000");

							d3.select(point).transition().duration(1500)
							.attr('cx', xScaleYears(yr) + axesOffset*1/2)
							.attr('cy', yWins(lotteryPicks[i]["stats"][j]['wins']) + axesOffset*2/5);
						}
					}
				}
			});
		
		}
		yrOffset++;
		yr++;		
	}

	//from http://stackoverflow.com/questions/15929453/d3-js-dont-start-new-transition-until-the-previous-one-has-finished
	function lockoutSubmit(button) {
		button = document.getElementById("moveHorse");

	    button.setAttribute('disabled', true);

	    setTimeout(function(){
	        button.removeAttribute('disabled');
	    }, 1500)
	}
</script>
<div>Data from <a href="http://basketball-reference.com">basketball-reference.com</a>.</div>
</body>

</html>