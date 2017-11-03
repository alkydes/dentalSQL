<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Goto.Dentist by Jeong & Moon</span></a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-ex-collapse"> 		
        		<ul class="nav navbar-nav navbar-right">

<?php
// echo $this->session->userdata('firstname');
if($this->session->userdata('is_login'))
{
?>
    		<li class="dropdown mega-dropdown active">
			    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-circle-o-notch fa-spin"></i></a>				
				<div class="dropdown-menu mega-dropdown-menu">
                    <div class="container-fluid">
    				    <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="patient">
                            <ul class="nav-list list-inline">
                                <li><a href="/patient/patientlogin/"><i class="fa fa-user fa-5x"></i><span>Patient Login</span></a></li>
                                <li><a href="/patient/createpatient/"><i class="fa fa-user-plus fa-5x"></i><span>Register</span></a></li>                                             
                                <li><a href="/patient/survey/"><i class="fa fa-pencil-square-o fa-5x"></i><span>Survey</span></a></li>
                                <li><a href="/patient/dentalreports/"><i class="fa fa-tasks fa-5x"></i><span>View</span></a></li>
                            </ul>
                          </div>
                          <div class="tab-pane" id="doctor">
                            <ul class="nav-list list-inline">
                                <li><a href="/dentist/dentistlogin/"><i class="fa fa-user-md fa-5x"></i><span>Doctor Login</span></a></li>
                                <li><a href="/patient/createpatient/"><i class="fa fa-user-plus fa-5x"></i><span>Patient Registration</span></a></li>
                                <li><a href="/dentist/listpatient/"><i class="fa fa-users fa-5x"></i><span>Patient List</span></a></li>
                                <!--li><a href="/dentist/timeline/"><i class="fa fa-tasks fa-5x"></i><span>Record</span></a></li-->
                                <li><a href="/dentist/statistics/all"><i class="fa fa-area-chart fa-5x"></i><span>Statistics</span></a></li>
                            </ul>
                          </div>
                          <div class="tab-pane" id="company">
                            <ul class="nav-list list-inline">
                                <li><a href="/company/companylogin/"><i class="fa fa-building fa-5x"></i><span>Company Login</span></a></li>
                                <li><a href="/company/registerproducts/"><i class="fa fa-cubes fa-5x"></i><span>Register Products</span></a></li>
                                <li><a href="/company/statistics/"><i class="fa fa-area-chart fa-5x"></i><span>Statistics</span></a></li>
                            </ul>
                          </div>
                          <div class="tab-pane" id="institute">
                            <ul class="nav-list list-inline">
                                <li><a href="/institute/institutelogin/"><i class="fa fa-institution fa-5x"></i><span>Institution Login</span></a></li>
                                <li><a href="/institute/createdentist/"><i class="fa fa-stethoscope fa-5x"></i><span>Enroll</span></a></li>                                                                                        
                                <li><a href="/institute/database/"><i class="fa fa-database fa-5x"></i><span>Database</span></a></li>
                                <li><a href="/institute/statistics"><i class="fa fa-area-chart fa-5x"></i><span>Statistics</span></a></li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                       <li class="active"><a href="#patient" role="tab" data-toggle="tab">Patient</a></li>
                       <li><a href="#doctor" role="tab" data-toggle="tab">Doctor</a></li>
                       <li><a href="#company" role="tab" data-toggle="tab">Company</a></li>
                       <li><a href="#institute" role="tab" data-toggle="tab">Institution</a></li>
                    </ul>                    
				</div>				
			</li>
<?php 
}
?>
			
			
        		</ul>
			</div>
		</div>
	</div>