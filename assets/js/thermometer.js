//Width and height
var w = window.innerWidth/1.2;
var h = window.innerHeight/1.5;

/* scale for thermometer 
 * input domain is the Celsius scale (-30°C to 60°C)
 * output range extend is the height of the rect.thermometer 
 */
var scale_user = d3.scale.linear().domain([0,210]).range([0,h/1.1]);   
var scale_team = d3.scale.linear().domain([0,2100]).range([0,h/1.1]);
// scale for yAxis label
var yAxis_user = d3.scale.linear().domain([0,210]) .range([h/1.1,0]); 
var yAxis_team = d3.scale.linear().domain([0,2100]) .range([h/1.1,0]); 

var svg = d3.select("article")
            .append("svg")
            .attr("width", w)
            .attr("height", h)
            
            svg.append("rect").classed("thermometer",true)
			.attr({
				width: 20,
				height: h/1.1,
				rx: 10, 
				ry: 10,
				x: 0.45*w,//60,
				y: 10
			})
			svg.append("rect").classed("thermometer",true)
			.attr({
				width: 20,
				height: h/1.1,
				rx: 10, 
				ry: 10,
				x: 0.55*w,//160,
				y: 10
			});

var svg = d3.select("article svg");

svg.append("g") .attr("transform", "translate("+String(0.45*w-50)+",10)")
		.call(d3.svg.axis().scale(yAxis_user).orient("right").ticks(15));

svg.append("g") .attr("transform", "translate("+String(0.55*w+60)+",10)")
		.call(d3.svg.axis().scale(yAxis_team).orient("left").ticks(15));

svg.append("text").text("Your Goal")
					.attr("x", 0.45*w-110)
					.attr("y", 30)
					.attr("font-family", "sans-serif");

svg.append("text").text("Team Goal")
					.attr("x", 0.55*w+70)
					.attr("y", 30)
					.attr("font-family", "sans-serif");

var displayUserTherm = function(num_pushups_user, num_pushups_team){
	if (num_pushups_user>=210) {
		$("#alert1").addClass("alert alert-success");
			$("#alert1").text('Congratulations! You have reached your individual goal!');
	}

	if (num_pushups_team>=2100) {
		$("#alert1").addClass("alert alert-success");
			$("#alert1").text('Congratulations! You have reached your team goal!');
	}

	var mercuryDiv1 =svg.selectAll("rect.mercury")
					.data([scale_user(num_pushups_user)], function(d){return d;});
	var mercuryDiv2 =svg.selectAll("rect.mercury")
					.data([scale_team(num_pushups_team)], function(d){return d;});

	mercuryDiv1
		.enter()
		.append("rect")
		.classed("mercury",true)
		.attr({
			y: h/1.1 + 10,
			height: 0,
			x: 0.45*w+1, //61,
			rx: 10, 
			ry: 10,
			width: 18
		});

	mercuryDiv1
		.transition()
		.attr({
			y: function(d){
				if (d>=scale_user(210)) {
					return h/1.1-scale_user(210)+10;
				} else {
					return h/1.1 - d + 10;
				}
			},
			height: function(d){
				if (d>=scale_user(210)) {
					return scale_user(210);
				} else {
					return d;
				}
			},
		})

			.duration(1000);

	
	mercuryDiv1
		.exit().remove();


	mercuryDiv2
		.enter()
		.append("rect")
		.classed("mercury",true)
		.attr({
			y: function(d){
				return  h/1.1 + 10;	
			},
			height: function(d){
				return 0;	
			},
			x: 0.55*w+1,//161,
			rx: 10, 
			ry: 10,
			width: 18
		});

	mercuryDiv2
		.transition()
		.attr({
			y: function(d){
				if (d>=scale_team(2100)) {
					return h/1.1-scale_team(2100)+10;
				} else {
					return h/1.1 - d + 10;
				}
			},
			height: function(d){
				if (d>=scale_team(2100)) {
					return scale_team(2100);
				} else {
					return d;
				}
			},
		})

			.duration(1000);

	
	mercuryDiv2
		.exit().remove();
};



$(document).ready(function() { 
	var num_pushups_user = $("#user_count").attr('value');
	var num_pushups_team = $("#team_count").attr('value');
	console.log("USER: " + num_pushups_user);
	console.log("TEAM: " + num_pushups_team);
	displayUserTherm(num_pushups_user, num_pushups_team);
});

