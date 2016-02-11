var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	
	var lineChartData = {
			labels : ["January","February","March","April","May","June","July","Aout","Septembre","Octobre","Novombre","Decembre"],
			datasets : [
				
				{
					label: "My Second dataset",
					fillColor : "rgba(0, 0, 0, 0)",
					strokeColor : "rgba(48, 164, 255, 20)",
					pointColor : "rgba(48, 164, 255, 1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(48, 164, 255, 1)",
					data : [0,0,0,0,0,0,0,0,0,0,0,0]
				}
			]

		}
		
	

	

window.onload = function(){
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true
	});
	
};