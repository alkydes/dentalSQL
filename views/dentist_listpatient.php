<div class="section">
	<div class="container">
		<div class="row">
				<!--div class="col-md-2"></div-->
				<!--div class="col-md-10"-->
			<div class="col-md-12">
							
				<div class="row" style="margin-top : 20px; margin-bottom : 20px;">
				
					<div class="col-md-12">
						


							
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn" type="button" onClick="search_value.value = '';act_search(0);">Clear</button>
							</span>
							<INPUT type="text" class="form-control" placeholder=" Search" style="width:100%; display:inline-block; padding: 0 0 0 0;" autocomplete="off" value="" size="10" id="search_value" onkeyup="act_search(1);">
							<div class="input-group-btn">
								<button class="btn" ng-click="search()" type="submit"><i class="fa fa-search"></i></button>
							</div>
						</div>
						<h4></h4>

					</div>


					<div class="col-md-12">

							
							<div id="patientlist_timeline"></div>


					</div>
				</div>					
			</div>
		</div>
	</div>
</div>

