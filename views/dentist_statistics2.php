
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/d3/3.0.8/d3.min.js"></script>
        <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>


    <div>

        <script>
            /* Globals */
            var w = 900, h = 550, m = 35, max = min = 0;
            /* Data Given */
            data = {
                treatments: [// Order matters | data.treatments[a][i].t is always less than data.treatments[a][i+1].t
                    [
                        //concurrent therapy
                        {t: 0, d: 0, n: 20},
                        {t: 11.267, d: 1, n: 20},
                        {t: 31.2, d: 1, n: 19},
                        {t: 33.167, d: 0, n: 18},
                        {t: 33.367, d: 1, n: 17},
                        {t: 35.667, d: 1, n: 16},
                        {t: 39.033, d: 0, n: 15},
                        {t: 39.3, d: 1, n: 14},
                        {t: 40.067, d: 1, n: 13},
                        {t: 53.867, d: 0, n: 12},
                        {t: 56.7, d: 1, n: 11},
                        {t: 56.9, d: 0, n: 10},
                        {t: 57.7, d: 1, n: 9},
                        {t: 59.4, d: 1, n: 8},
                        {t: 71.3, d: 1, n: 7},
                        {t: 73.333, d: 1, n: 6},
                        {t: 81.967, d: 0, n: 5},
                        {t: 82.367, d: 0, n: 4},
                        {t: 84.867, d: 0, n: 3},
                        {t: 98.667, d: 0, n: 2},
                        {t: 125.9, d: 0, n: 1}
                    ],
                    [
                        //induction therapy
                        {t: 0, d: 0, n: 6},
                        {t: 5.767, d: 1, n: 6},
                        {t: 60.733, d: 0, n: 5},
                        {t: 105.9, d: 1, n: 4},
                        {t: 110.067, d: 1, n: 3},
                        {t: 117.367, d: 1, n: 2},
                        {t: 287.967, d: 0, n: 1}
                    ],
                    [
                        //induction + chemo
                        {t: 0, d: 0, n: 11},
                        {t: 12.7, d: 1, n: 11},
                        {t: 15.4667, d: 1, n: 10},
                        {t: 18.8667, d: 1, n: 9},
                        {t: 33.5333, d: 0, n: 8},
                        {t: 35.4333, d: 0, n: 6},
                        {t: 45.2333, d: 1, n: 5},
                        {t: 48.4333, d: 1, n: 4},
                        {t: 48.8333, d: 0, n: 3},
                        {t: 49.6333, d: 1, n: 2},
                        {t: 66.9667, d: 0, n: 1}
                    ],
                    [
                        //no Chemo
                        {t: 0, d: 0, n: 59},
                        {t: 5.7, d: 1, n: 59},
                        {t: 6.533, d: 1, n: 58},
                        {t: 7.2, d: 1, n: 57},
                        {t: 8.7, d: 1, n: 56},
                        {t: 10.267, d: 0, n: 55},
                        {t: 10.533, d: 0, n: 54},
                        {t: 11.9, d: 1, n: 53},
                        {t: 12.167, d: 1, n: 52},
                        {t: 12.467, d: 0, n: 51},
                        {t: 12.9, d: 1, n: 50},
                        {t: 13.1, d: 1, n: 49},
                        {t: 15.1, d: 1, n: 48},
                        {t: 15.167, d: 1, n: 47},
                        {t: 16.2, d: 1, n: 46},
                        {t: 17.167, d: 1, n: 45},
                        {t: 19.8, d: 1, n: 44},
                        {t: 20.433, d: 1, n: 43},
                        {t: 21, d: 1, n: 42},
                        {t: 22.3, d: 1, n: 41},
                        {t: 26.167, d: 1, n: 40},
                        {t: 26.6, d: 1, n: 39},
                        {t: 28.1, d: 1, n: 38},
                        {t: 29.8, d: 1, n: 37},
                        {t: 30.6, d: 1, n: 36},
                        {t: 31.033, d: 1, n: 35},
                        {t: 32.4, d: 1, n: 34},
                        {t: 32.433, d: 1, n: 33},
                        {t: 32.633, d: 1, n: 32},
                        {t: 36.367, d: 1, n: 31},
                        {t: 38.967, d: 1, n: 30},
                        {t: 41.467, d: 1, n: 29},
                        {t: 42.833, d: 1, n: 28},
                        {t: 44.667, d: 1, n: 27},
                        {t: 44.833, d: 1, n: 26},
                        {t: 47.667, d: 0, n: 25},
                        {t: 50.333, d: 1, n: 24},
                        {t: 50.633, d: 1, n: 23},
                        {t: 55.533, d: 1, n: 22},
                        {t: 57.7, d: 1, n: 21},
                        {t: 61.833, d: 1, n: 20},
                        {t: 63.367, d: 1, n: 19},
                        {t: 66.667, d: 1, n: 18},
                        {t: 78.633, d: 1, n: 17},
                        {t: 85.467, d: 1, n: 16},
                        {t: 85.967, d: 1, n: 15},
                        {t: 98.267, d: 1, n: 14},
                        {t: 105.867, d: 0, n: 13},
                        {t: 109.4, d: 1, n: 12},
                        {t: 116.2, d: 0, n: 11},
                        {t: 116.267, d: 1, n: 10},
                        {t: 136.133, d: 0, n: 9},
                        {t: 151.667, d: 1, n: 8},
                        {t: 152.1, d: 0, n: 7},
                        {t: 167.367, d: 1, n: 6},
                        {t: 192.5, d: 1, n: 5},
                        {t: 193.8, d: 1, n: 4},
                        {t: 195.6, d: 0, n: 3},
                        {t: 241.967, d: 1, n: 2},
                        {t: 279.1, d: 1, n: 1}]

                ]};
            /* Computed Data progression, survival, prob, censored */
            for (var a = 0; a < data.treatments.length; a++) {
                for (var b = 0; b < data.treatments[a].length; b++) {
                    var reed = data.treatments[a][b];
                    var brad = (b > 0) ? data.treatments[a][b - 1].n - reed.d : reed.n;

                    reed.progression = reed.d / reed.n;
                    reed.survival = 1 - reed.progression;
                    reed.prob = (b == 0) ? reed.survival : data.treatments[a][b - 1].prob * reed.survival;
                    max = (max < reed.t) ? reed.t : max;
                    reed.censored = (reed.n < brad) ? true : false;
                }
            }
            console.log(data);
            /* Begin d3.js */
            //Scalar functions
            var x = d3.scale.linear().domain([0, max]).range([0, w - m * 2]);
            var y = d3.scale.linear().domain([1, 0]).range([0, h - m]);
            //Define axses
            var xAxis = d3.svg.axis()
                    .scale(x)
                    .tickSize(2)
                    .tickPadding(6)
                    .orient("bottom");

            var yAxis = d3.svg.axis()
                    .scale(y)
                    .tickSize(2)
                    .tickPadding(6)
                    .orient("left");
            //This is the accessor function
            var lineFunction = d3.svg.line()
                    .x(function (d) {
                        return x(d.t) + 2 * m;
                    })
                    .y(function (d) {
                        return y(d.prob);
                    })
                    .interpolate("step-before");

            //Draw the svg container
            var kaplan = d3.select("body").append("svg")
                    .attr("width", w + (2 * m))
                    .attr("height", h + (4 * m));
            //Draw the lines
             var redLine = kaplan.append("path")
     	       .attr("d", lineFunction(data.treatments[0]))
    	        .attr("stroke", "#ff4c4c")
    	    	.attr("stroke-width", 3)
     	       .attr("fill", "none")
         	   .attr("opacity", 0.7)
         	   .on('mouseover', function(){
            	    var coordinates = d3.mouse(this);
                	var x = coordinates[0];
                	var y = coordinates[1];
                	d3.selectAll('.my-tooltip').remove();
                	kaplan.append("text")
                  	  .attr('class', 'my-tooltip')
                  	  .attr("x", x)
                   	 .attr("y", y)        
                   	 .text("message");                       
            	})
            .on('mouseout', function() {
                d3.selectAll('.my-tooltip').remove();
            });

            var blueLine = kaplan.append("path")
                    .attr("d", lineFunction(data.treatments[1]))
                    .attr("stroke", "#197319")
                    .attr("stroke-width", 3)
                    .attr("fill", "none")
                    .attr("opacity", 0.7);

            var thirdLine = kaplan.append("path")
                    .attr("d", lineFunction(data.treatments[2]))
                    .attr("stroke", "#6666ff")
                    .attr("stroke-width", 3)
                    .attr("fill", "none")
                    .attr("opacity", 0.7);

            var fourthLine = kaplan.append("path")
                    .attr("d", lineFunction(data.treatments[3]))
                    .attr("stroke", "#ffc04c")
                    .attr("stroke-width", 3)
                    .attr("fill", "none")
                    .attr("opacity", 0.7);

            //Draw the x-axis
            var theXAxis = kaplan.append("g")
                    .attr("class", "xaxis")
                    .attr("transform", "translate(" + 2 * m + "," + h + ")")
                    .call(xAxis)
                    .append("text")
                    .text("Overall Survival (in months)");

            //Draw the y-axis
            var theYAxis = kaplan.append("g")
                    .attr("class", "yaxis")
                    .attr("transform", "translate(" + 1.75 * m + ", " + m + ")")
                    .call(yAxis)
                    .append("text")
                    .attr('text-anchor', 'bottom')
                    .attr('transform', 'rotate(-90)')
                    .text("Survival Rate");
        </script>
    </div>