<style>
#success_message{ display: none;}
</style>

<div>&nbsp;</div>

<div class="container">

	<form class="well form-horizontal" action="/institute/insert_dentist" method="post"  id="registration_form">
	<fieldset>

	<!-- Form Name -->
	<legend><i class="fa fa-user-plus fa-5x" aria-hidden="true"></i></legend>

	<!-- Text input-->

	<div class="form-group">
	  <label class="col-md-4 control-label">First Name</label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
	  <input name="first_name" placeholder="First Name" class="form-control" type="text">
		</div>
	  </div>
	</div>

	<!-- Text input-->

	<div class="form-group">
	  <label class="col-md-4 control-label" >Last Name</label> 
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
	  <input name="last_name" placeholder="Last Name" class="form-control" type="text">
		</div>
	  </div>
	</div>

	<!-- Text input-->

	<div class="form-group">
		<label class="col-md-4 control-label" >Date of Birth</label> 
		<div class="col-md-4 inputGroupContainer">
			<div class="input-group date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input id="from-datepicker" name="date" type="text" placeholder="YYYY-MM-DD" class="form-control" />
			</div>
		</div>
	</div>	

	
	<!-- radio checks -->
	<div class="form-group">
		<label class="col-md-4 control-label">Gender</label>
		<div class="col-md-4">
			<div class="radio">
				<label>
					<input name="gender" type="radio" value="1" /> Male &nbsp;&nbsp;
				</label>
				<label>
					<input name="gender" type="radio" value="2" /> Female
				</label>
			</div>
		</div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Password</label>  
	   <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></span>
	  <input name="password" placeholder="Please enter your password" class="form-control" type="text">
		</div>
	  </div>
	</div>	
	
	<!-- Text input-->
		   <div class="form-group">
	  <label class="col-md-4 control-label">E-Mail</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
	  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
		</div>
	  </div>
	</div>


	<!-- Text input-->
	   
	<div class="form-group">
	  <label class="col-md-4 control-label">Phone #</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
	  <input name="phone" placeholder="010-5505-1212" class="form-control" type="text">
		</div>
	  </div>
	</div>

	<!-- Select Basic -->
   
	<div class="form-group"> 
	  <label class="col-md-4 control-label">Hospital</label>
		<div class="col-md-4 selectContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
		<select name="hospital" class="form-control selectpicker" >
		  <option value=" " >Please select your hospital</option>
		  <option>Dankook University Dental Hospital</option>
		</select>
	  </div>
	</div>
	</div>

	<!-- Text input-->

	<div class="form-group">
	  <label class="col-md-4 control-label">License Number</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
	  <input name="drcode" placeholder="License Number" class="form-control"  type="text">
		</div>
	</div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
		<label class="col-md-4 control-label" >License Date</label> 
		<div class="col-md-4 inputGroupContainer">
			<div class="input-group date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input id="from-drdatepicker" name="drdate" type="text" placeholder="YYYY-MM-DD" class="form-control" />
			</div>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Specialty</label>  
	   <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></span>
	  <input name="specialty" placeholder="Please enter your specialty" class="form-control" type="text">
		</div>
	  </div>
	</div>

	<!-- Text area -->
  
	<div class="form-group">
	  <label class="col-md-4 control-label">Description</label>
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
				<textarea class="form-control" name="comment" placeholder="Project Description"></textarea>
	  </div>
	  </div>
	</div>

	<!-- Success message -->
	<div class="alert alert-success" role="alert" id="success_message">Success <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thanks for contacting us, we will get back to you shortly.</div>

	<!-- Button -->
	<div class="form-group">
	  <label class="col-md-4 control-label"></label>
	  <div class="col-md-4">
		<button type="submit" class="btn btn-warning" >Send <i class="fa fa-paper-plane-o" aria-hidden="true"></i></span></button>
	  </div>
	</div>

	</fieldset>
	</form>
</div>