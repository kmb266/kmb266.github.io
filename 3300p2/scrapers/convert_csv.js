d3.csv("lottery_picks_stats_data.csv", function(error,data){
		//Turn this shit to json
		var j = 0;
		console.log("{")
		while (j < data.length) {
			//{year : [{p1 : {year 1 : {win1 : 2}, {team1 : NOR}},  y2 }, p2]}
			//{year : {p1 : [{year : 2014, win : 2, team : NOR},  y2 ]}, p2}, year2 : }
			console.log("'"+data[j]["Year_Drafted"]+"': [");
			for (var k = 0; k < 7; k++) {
				console.log("{ 'name' : ")
				console.log("'"+data[j]["Player"]+"', 'stats' : [");
				var l = 1;
				while ((data[j]["Year"+l] != "") && (data[j]["Year"+l] != undefined)) {
					console.log("{'year' : "+data[j]["Year"+l]+", 'wins': "+data[j]["wins"+l]+", 'team': '"+data[j]["Team"+l]+"' },")
				l++;
			}
			console.log("]},")
			j++;
		}
		console.log("],")
	}
	console.log("}")
});