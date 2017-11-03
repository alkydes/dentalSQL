<style>
svg {
  display: block;
  font-size: 11px;
  margin: auto;
}

.axis path,
.axis line {
  fill: none;
  shape-rendering: crispEdges;
  stroke: #333;
}

text {
  -moz-user-select: none;
  -ms-user-select: none;
  -webkit-user-select: none;
  fill: #333;
  font-family: Helvetica, Arial, sans-serif;
  text-transform: uppercase; 
  user-select: none;
}

text::selection {
  background: none;
}

.legend__item {
  cursor: pointer;
}
</style>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="btn-toolbar" role="toolbar">
					<div class="btn-group btn-group-justified">
						<a href="/dentist/statistics/all" type="button" class="btn btn-default">all</a>
						<a href="/dentist/statistics/color_match" type="button" class="btn btn-default">color_match</a>
						<a href="/dentist/statistics/cavosurface_maginal_discoloration" type="button" class="btn btn-default">cavosurface_maginal_discoloration</a>
					</div>
				</div>	
					
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<div id="js-app"></div>
					
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<div class="btn-toolbar" role="toolbar">
					<div class="btn-group btn-group-justified">
						<a href="/dentist/statistics/anaotomic_form" type="button" class="btn btn-default">anaotomic_form</a>
						<a href="/dentist/statistics/marginal_adaptation" type="button"class="btn btn-default">marginal_adaptation</a>
						<a href="/dentist/statistics/caries" type="button"class="btn btn-default">caries</a>
					</div>
				</div>	
					
			</div>
		</div>
	</div>
</div>
