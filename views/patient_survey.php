<style>
#success_message{ display: none;}


<!-- 
Likert Scale Survey
https://codepen.io/Buttonpresser/pen/qiuIx 
-->
h1.Likert-header {
  padding: 100px 0 0 4.25%;
  margin: 100px 0 0 0;
}
form .statement {
  display:block;
  font-size: 16px;
  font-weight: bold;
  text-align:center;
  padding: 20px 0 0 4.25%;
  margin-bottom:10px;
}
form .vas {
  list-style:none;
  width:100%;
  margin:0;
  padding:0 0 0 0px;
  display:block;
  border-bottom:2px solid #efefef;
}
form .vas:last-of-type {border-bottom:0;}
form .vas:before {
  content: '';
  position:relative;
  top:11px;
  left:4.75%;
  display:block;
  background-color:#efefef;
  height:4px;
  width:84%;
}
form .vas li {
  display:inline-block;
  width:8%;
  text-align:center;
  vertical-align: top;
}
form .vas li input[type=radio] {
  display:block;
  position:relative;
  top:0;
  left:50%;
  margin-left:-6px;
  
}
form .Likert:last-of-type {border-bottom:0;}
form .Likert:before {
  content: '';
  position:relative;
  top:11px;
  left:9.5%;
  display:block;
  background-color:#efefef;
  height:4px;
  width:78%;
}
form .Likert li {
  display:inline-block;
  width:19%;
  text-align:center;
  vertical-align: top;
}
form .Likert li input[type=radio] {
  display:block;
  position:relative;
  top:0;
  left:50%;
  margin-left:-6px;
  
}

</style>

<div class="container">

	<form class="well form-horizontal" action=" " method="post"  id="survey_form">
	<fieldset>

		<!-- Form Name -->
		<legend><i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i></legend>

		<!-- radio checks -->
		<h1 class="Likert-header">Fear</h1>


		<div class="form-group">
			<label class="statement">If you had to go to the dentist tomorrow, how would you feel about it?</label>
		  	<label class="col-md-3 control-label" ></label> 
			<div class="col-md-7 inputGroupContainer">
			<ul>
				  <li>
					<input type="radio" name="Corah1" value="1">
					<label class="control-label">I would look forward to it as a reasonably enjoyable experience.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah1" value="2">
					<label class="control-label">I wouldn't care one way or the other.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah1" value="3">
					<label class="control-label">I would be a little uneasy about it.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah1" value="4">
					<label class="control-label">I would be afraid that it would be unpleasant and painful.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah1" value="5">
					<label class="control-label">I would be very frightened of what the dentist might do.</label>
				  </li>

			</ul>
			</div>
		</div>
		<div class="form-group">
			<label class="statement">When you are waiting in the dentist's office for your turn in the chair, how do you feel?</label>
		  	<label class="col-md-3 control-label" ></label> 
			<div class="col-md-7 inputGroupContainer">
			<ul class='Likert'>
				  <li>
					<input type="radio" name="Corah2" value="1">
					<label class="control-label">Relaxed.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah2" value="2">
					<label class="control-label">A little uneasy.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah2" value="3">
					<label class="control-label">Tense.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah2" value="4">
					<label class="control-label">Anxious.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah2" value="5">
					<label class="control-label">So anxious.*</label>
				  </li>
				<br><br>*So anxious that I sometimes break out in a sweat or almost feel physically sick.
			</ul>
			</div>
		</div>
		<div class="form-group">
			<label class="statement">When you are in the dentist's chair waiting while he gets his dril ready to begin working on your teeth, how do you feel?</label>
		  	<label class="col-md-3 control-label" ></label> 
			<div class="col-md-7 inputGroupContainer">
			<ul class='Likert'>
				  <li>
					<input type="radio" name="Corah3" value="1">
					<label class="control-label">Relaxed.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah3" value="2">
					<label class="control-label">A little uneasy.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah3" value="3">
					<label class="control-label">Tense.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah3" value="4">
					<label class="control-label">Anxious.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah3" value="5">
					<label class="control-label">So anxious.</label>
				  </li>
				<br><br>*So anxious that I sometimes break out in a sweat or almost feel physically sick.
			</ul>
			</div>
		</div>
		<div class="form-group">
			<label class="statement">You are in the dentist's chair to have your teeth cleaned. While you are waiting and the dentistis getting out the instruments which he will use to scrape your teeth around the gums, how do you feel?</label>
		  	<label class="col-md-3 control-label" ></label> 
			<div class="col-md-7 inputGroupContainer">
			<ul class='Likert'>
				  <li>
					<input type="radio" name="Corah4" value="1">
					<label class="control-label">Relaxed.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah4" value="2">
					<label class="control-label">A little uneasy.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah4" value="3">
					<label class="control-label">Tense.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah4" value="4">
					<label class="control-label">Anxious.</label>
				  </li>
				  <li>
					<input type="radio" name="Corah4" value="5">
					<label class="control-label">So anxious.</label>
				  </li>
				<br><br>*So anxious that I sometimes break out in a sweat or almost feel physically sick.
			</ul>
			</div>
		</div>		
		


		<!-- radio checks -->
		<h1 class="Likert-header">Pain</h1>
		<label class="statement">It can often be hard for patients to describe dental pain. But, by following a simple set of guided questions you can quickly and easily find the key information you need to help assess dental pain.</label>

		<!-- Text input-->
		<div class="form-group">
			<label class="statement">Where is the pain?</label>
		  <label class="col-md-4 control-label">Site</label>  
		   <div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
				<textarea name="site" class="form-control" placeholder="Left or right? upper or lower? Incisor or molar? Gum or Tongue?"></textarea>
			</div>
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="form-group">
			<label class="statement">What triggers it?</label>
		  <label class="col-md-4 control-label">Onset</label>  
		   <div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
				<textarea name="onset" class="form-control" placeholder="Cold? Hot? Breathing? Chewing? Sweet? Physical activity?"></textarea>
			</div>
		  </div>
		</div>	
		
		<!-- Text input-->
		<div class="form-group">
			<label class="statement">How does the pain feel?</label>
		  <label class="col-md-4 control-label">Character</label>  
		   <div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-bolt" aria-hidden="true"></i></span>
				<textarea name="character" class="form-control" placeholder="Sharp? Dull? Aching? Throbbing? Surging? Tingling?"></textarea>
			</div>
		  </div>
		</div>	
		
		<!-- Text input-->
		<div class="form-group">
			<label class="statement">Does it feel as if it’s spreading?</label>		
		  <label class="col-md-4 control-label">Radiate</label>  
		   <div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
				<textarea name="radiate" class="form-control" placeholder="Jaw bone? Jaw joint? Ear? Sinus? Head? Neck? Shoulder?"></textarea>
			</div>
		  </div>
		</div>			

		<!-- Text input-->
		<div class="form-group">
			<label class="statement">Is there anything else caused by the pain?</label>		
		  <label class="col-md-4 control-label">Association</label>  
		   <div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></span>
				<textarea name="association" class="form-control" placeholder="Abscess, Bleeding, Swelling, Facial rash, Dizziness, Nausea, Chest pain"></textarea>
			</div>
		  </div>
		</div>	

		<!-- Text input-->
		<div class="form-group">
			<label class="statement">How long does it last? Is there a pattern?</label>		
		  <label class="col-md-4 control-label">Time</label>  
		   <div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
				<textarea name="time" class="form-control" placeholder="Persistent? Once in a day? Worse at night? Bad when you stand up?"></textarea>
			</div>
		  </div>
		</div>	
	
		<!-- Text input-->
		<div class="form-group">
			<label class="statement">Anything that makes it worse or better?</label>		
		  <label class="col-md-4 control-label">Exacerbation</label>  
		   <div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-fire" aria-hidden="true"></i></span>
				<textarea name="exacerbation" class="form-control" placeholder="Pain killer? Hot or Cold water? Running? Airplane?"></textarea>
			</div>
		  </div>
		</div>	
				
		<!-- VAS -->
		<div class="form-group">
			<label class="statement">Scale of 1-10 how painful is it?</label>
		  	<label class="col-md-3 control-label" >Severity</label> 
			<div class="col-md-7 inputGroupContainer">    
				<ul class='vas'>
				  <li>
					<input type="radio" name="vas_pain" value="0">
					<label class="control-label">0</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="1">
					<label class="control-label">1</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="2">
					<label class="control-label">2</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="3">
					<label class="control-label">3</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="4">
					<label class="control-label">4</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="5">
					<label class="control-label">5</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="6">
					<label class="control-label">6</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="7">
					<label class="control-label">7</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="8">
					<label class="control-label">8</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="9">
					<label class="control-label">9</label>
				  </li>
				  <li>
					<input type="radio" name="vas_pain" value="10">
					<label class="control-label">10</label>
				  </li>
				</ul>
			<img src="<?php echo base_url(); ?>/img/pain_scale.png" style="width: 95%;">
			</div>
		</div>

		<!-- Success message -->
		<div class="alert alert-success" role="alert" id="success_message">Success <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thanks for your survey, we will get back to you shortly.</div>

		<!-- Button -->
		<div class="form-group">
			<button type="submit" class="btn btn-lg btn-warning btn-block" >Send <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
		</div>

	</fieldset>
	</form>
</div>


