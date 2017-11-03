	<script src="<?php echo base_url(); ?>script/dropzone/dropzone.min.js"></script>

	<script src="<?php echo base_url(); ?>script/vis/dist/vis.js"></script>
	
	<script>		


		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone("#my-dropzone", {

			
			url: "<?php echo site_url("dentist/upload") ?>",
			acceptedFiles: "image/*",
			addRemoveLinks: false,
			removedfile: function(file) {
				var name = file.name;

				$.ajax({
					type: "post",
					url: "<?php echo site_url("dentist/remove") ?>",
					data: { file: name },
					dataType: 'html'
				});

				// remove the thumbnail
				var previewElement;
				return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
			},

			
				
			complete: function(){
				var me = this;
				$.get("<?php echo site_url("dentist/list_file") ?>", function(data) {
					if (data.length > 0) {
						$.each(data, function(key, value) {
							var mockFile = value;
							items.add({id: items.length+1, group: value.category, content: '<span data-target="#modal_2" data-toggle="modal" onclick="modal_cha(' + value.category + ', \'' + value.folder_name + '\')">#all</span>', start: value.folder_name});
							timeline.fit();
						});
					}
				});
				
			},
			

			init: function() {
				var me = this;
				$.get("<?php echo site_url("dentist/list_files") ?>", function(data) {
					// if any files already in server show all here
					if (data.length > 0) {
						$.each(data, function(key, value) {
							var mockFile = value;
							/*
							me.emit("addedfile", mockFile);
							me.emit("thumbnail", mockFile, "<?php echo base_url(); ?>uploads/" + value.folder_name + "/" + value.name);
							me.emit("complete", mockFile);
							*/		

							items.add({id: items.length+1, group: value.category, content: '<span data-target="#modal_2" data-toggle="modal" onclick="modal_cha(' + value.category + ', \'' + value.folder_name + '\')">#all</span>', start: value.folder_name});
							timeline.fit();
							
						});
					}
				});
			}
		});
/*
		myDropzone.on("addedfile", function(file) {
			var me = this;
			$.get("<?php echo site_url("dentist/upload") ?>", function(data) {
				if (data.length > 0) {
					$.each(data, function(key, value) {
						var mockFile = value;
						items.add({id: items.length+1, group: value.category, content: '<span data-target="#20130420" data-toggle="modal">#all</span>', start: value.folder_name});
					});
				}
			});
		});
*/

		// DOM element where the Timeline will be attached
		var container = document.getElementById('visualization');

		// create a data set with groups
		var names = ['Visit', 'Survey', 'Photo'];
		var groups = new vis.DataSet();
		for (var g = 0; g < 3; g++) {
			groups.add({id: g, content: names[g]});
		}

		// Create a DataSet (allows two way data-binding)
		var items = new vis.DataSet([
			{id: 1, group: 0, content: '<span data-target="#20130420" data-toggle="modal">charting</span>', start: '2013-04-20'},
		//	{id: 2, group: 1, content: '<span data-target="#20130414" data-toggle="modal">#all</span>', start: '2013-04-14'},
		//	{id: 3, group: 2, content: '<span data-target="#20130416" data-toggle="modal">#all</span>', start: '2013-04-16'},
		//	{id: 4, group: 3, content: '<span data-target="#20130418" data-toggle="modal">#all</span>', start: '2013-04-18'}
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