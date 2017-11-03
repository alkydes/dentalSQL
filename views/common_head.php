<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dental Survival Estimates</title>

	<!-- 공용 폰트 -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<!-- 공용 스타일시트 -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="<?php echo base_url(); ?>script/dropzone/dropzone.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>script/vis/dist/vis.css" rel="stylesheet" type="text/css" />

	<!-- 공용 자바스크립트 -->
	<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://d3js.org/d3.v4.min.js"></script>
	
	<!-- 공용 스타일선언 -->	
	<style>
		@font-face {
			font-family:'anatomy';
			src: url('/font/Den1Font.ttf');
		}
		body {
			background: #f7f7f7;
			font-family: 'Montserrat', sans-serif;
		}

		.dropzone {
			background: #fff;
			border: 2px dashed #ddd;
			border-radius: 5px;
		}

		.dz-message {
			color: #999;
		}

		.dz-message:hover {
			color: #464646;
		}

		.dz-message h3 {
			font-size: 200%;
			margin-bottom: 15px;
		}
		.dropdown-submenu {
			position: relative;
		}
		
		.dropdown-submenu .dropdown-menu {
			top: 0;
			left: 100%;
			margin-top: -1px;
		}
		.modal-dialog.modal-fullsize { 
			width: 100%; 
			height: 80%;
		}
		.modal-content.modal-fullsize {
		  height: auto;
		  min-height: 80%;
		  border-radius: 0; 
		}


/*
Credits:
Code snippet by @maridlcrmn (Follow me on Twitter)
Images by Nike.com (http://www.nike.com/us/en_us/)
Logo by Sneaker-mission.com (http://www.sneaker-mission.com/)
*/
		.navbar-brand { 
  			height: 50px;
  			background-size: 50px;  
		}
		.nav-tabs {
  			display: inline-block;
  			border-bottom: none;
  			padding-top: 15px;
		}
		.nav-tabs > li > a, 
		.nav-tabs > li > a:hover, 
		.nav-tabs > li > a:focus, 
		.nav-tabs > li.active > a, 
		.nav-tabs > li.active > a:hover,
		.nav-tabs > li.active > a:focus {
  			border: none;
  			border-radius: 0;
		}
		.nav-list { border-bottom: 1px solid #eee; }
		.nav-list > li { 
  			padding: 20px 15px 15px;
  			border-left: 1px solid #eee; 
		}
		.nav-list > li:last-child { border-right: 1px solid #eee; }
		.nav-list > li > a:hover { text-decoration: none; }
		.nav-list > li > a > span {
  			display: block;
  			text-transform: uppercase;
		}

		.mega-dropdown { position: static !important; }
		.mega-dropdown-menu {
  			padding: 20px 15px 15px;
  			text-align: center;
  			width: 100%;
		}

<!-- 부트스트랩 전체의 폭설정 -->	
		.container {
		  width: auto;
		  max-width: 1650px;
		  padding: 0 30px;
		}
		
	</style>
</head>


<body>