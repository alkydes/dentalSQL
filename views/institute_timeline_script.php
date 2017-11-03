<script src="<?php echo base_url(); ?>script/vis/dist/vis.js"></script>

<script>		

	// ajax!!! 가 필요해!

	// DOM element where the Timeline will be attached
	var container = document.getElementById('patientlist_timeline');

	// create a data set with groups
	var names = ['정o교', '문o진', 'James Dean', 'Micheal Jackson'];
	
	
	var groups = new vis.DataSet();
	for (var g = 0; g < 4; g++) {
		groups.add({id: g, content: names[g]});
	}

	// Create a DataSet (allows two way data-binding)
	var items = new vis.DataSet([
		{id: 1, group: 0, content: '<span data-target="#20130420" data-toggle="modal">3M</span>', start: '2013-04-20', end: '2015-03-22'},
		{id: 2, group: 1, content: '<span data-target="#20130414" data-toggle="modal">Sunmedical</span>', start: '2010-04-14', end: '2015-03-22'},
		{id: 3, group: 2, content: '<span data-target="#20130416" data-toggle="modal">Dentsply</span>', start: '2002-04-16', end: '2008-03-22'},
		{id: 4, group: 3, content: '<span data-target="#20130418" data-toggle="modal">Ivoclar Vivadent</span>', start: '2016-04-18', end: '2017-03-22'}
	]);

	// Configuration for the Timeline
	var options = {
		editable: false,
		min: "2000-01-01",
		//max: new Date,
		max: new Date(new Date().getTime()+(365*24*60*60*1000)),
		zoomMin: 600000*60*24
	};

	// Create a Timeline
	var timeline = new vis.Timeline(container, items, options, groups);


	//$('#example').timeliny();
	$(document).ready(function(){
		$('.dropdown-submenu a.test').on("click", function(e){
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});
	});



	

</script>