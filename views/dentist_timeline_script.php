
	<script src="<?php echo base_url(); ?>script/dropzone/dropzone.min.js"></script>
	<script src="<?php echo base_url(); ?>script/vis/dist/vis.js"></script>
	
	<script>		

		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone("#my-dropzone", {

			
			url: "<?php echo site_url("dentist/upload/$p_idx") ?>",
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
				$.get("<?php echo site_url("dentist/list_file/$p_idx") ?>", function(data) {
					if (data.length > 0) {
						$.each(data, function(key, value) {
							var mockFile = value;
							items.add({id: items.length+1, group: value.category, content: '<span data-target="#modal_2" data-toggle="modal" onclick="modal_cha(' + value.category + ', \'' + value.folder_name + '\')">' + value.folder_name + '</span>', start: value.folder_name});
							timeline.fit();
						});
					}
				});
				
			},
			

			init: function() {
				var me = this;

				//photoes
				$.get("<?php echo site_url("dentist/list_files/$p_idx") ?>", function(data) {
					// if any files already in server show all here
					if (data.length > 0) {
						$.each(data, function(key, value) {
							var mockFile = value;
							/*
							me.emit("addedfile", mockFile);
							me.emit("thumbnail", mockFile, "<?php echo base_url(); ?>uploads/" + value.folder_name + "/" + value.name);
							me.emit("complete", mockFile);
							*/		

							items.add({id: items.length+1, group: value.category, content: '<span data-target="#modal_2" data-toggle="modal" onclick="modal_cha(' + value.category + ', \'' + value.folder_name + '\')">' + value.folder_name + '</span>', start: value.folder_name});
							timeline.fit();
							
						});
					}
				});

				//charts
				$.get("<?php echo site_url("dentist/list_charts/$p_idx") ?>", function(data) {
					// if any files already in server show all here
					if (data.length > 0) {
						$.each(data, function(key, value) {
							var mockFile = value;
							
							items.add({id: items.length+1, group: 0, content: '<span data-target="#chart_insert" data-toggle="modal" onclick="chart_list(\'' + value.folder_name + '\')">' + value.folder_name + '</span>', start: value.folder_name});
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
		var names = ['Charts', 'Photo', 'Periapical', 'Panorama'];
		var groups = new vis.DataSet();
		for (var g = 0; g < 4; g++) {
			groups.add({id: g, content: names[g]});
		}

		// Create a DataSet (allows two way data-binding)
		var items = new vis.DataSet([
		//	{id: 1, group: 0, content: '<span data-target="#20130420" data-toggle="modal">charting</span>', start: '2013-04-20'},
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

		function modal_cha(a, b){
			$("#modal_2_html").html("");
			$.ajax({
				url: "<?php echo site_url("dentist/get_images/$p_idx") ?>",
				type: "POST",
				data: {
					category : a,
					folder_name : b
				},
				cache: false,
				dataType: 'json',
				success: function(data) {	
					var args = "";
					if (data.length > 0) {
						$.each(data, function(key, value) {
							var mockFile = value;
							if (args == "")
							{
								arg = "<div class='item active' style='text-align: -webkit-center;'><img src='<?php echo base_url(); ?>uploads/" + b + "/" + value.local_name + "'><div class='carousel-caption' style='text-align: -webkit-left;'><h2><?php echo($p_lastname.$p_firstname); ?></h2><p>" + value.folder_name + "</p></div></div>";
							}
							else
							{
								arg = "<div class='item' style='text-align: -webkit-center;'><img src='<?php echo base_url(); ?>uploads/" + b + "/" + value.local_name + "'><div class='carousel-caption' style='text-align: -webkit-left;'><h2><?php echo($p_lastname.$p_firstname); ?></h2><p>" + value.folder_name + "</p></div></div>";
							}
							
							args = args + arg;
						});
					}					
					$('#modal_2_html').html(args);
					$('#modal_2_chart_button').html('<a class="btn btn-default" data-target="#chart_insert" data-toggle="modal" onclick="chart_list(\'' + b + '\')">Chart</a><a class="btn btn-default" data-dismiss="modal">Close</a>');

					
				},
				error: function(request,status,error){
				 	alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error); 				
				},
			})
		}


// xml 파싱을 한번만 하기 위해..

		var url = "http://goto.dentist/chart_list.xml";
		var doc = getXMLDom(url);


		function incrementValue(e, a, b)
		{
			var c = $(e).text();
			var d = "";
			var f = doc.getElementsByTagName(a)[0].getElementsByTagName(b)[0].getElementsByTagName("value");	
			var g = f.length - 1;

			if( c == "" )
			{
				$(e).text(f[0].childNodes[0].nodeValue);
			}
			else
			{
				if( c == f[g].childNodes[0].nodeValue)
				{
					$(e).text("");
				}
				else
				{
					for (var i = 0; i < f.length ; i++)
					{
						if( c == f[i].childNodes[0].nodeValue )
						{
							$(e).text(f[i+1].childNodes[0].nodeValue);
						}
					}
				}
			}
				
		}

		function test_dmf(p_date)
		{
			$(".chart").each(function(index, elem){
				if($(elem).html() != "")
				{
					var elem_class = $(elem).attr("class");
					var elem_classArray = elem_class.split(" ");
					var t_table = elem_classArray[1];
					var t_coloum = elem_classArray[2];
					var t_tn = elem_classArray[3];
					var elem_html = $(elem).html();
					/*
					alert(t_table);
					alert(t_coloum);
					alert(t_tn);
					alert(elem_html);
					*/

					$.ajax({
						url: "<?php echo site_url("dentist/insert_chart/$p_idx") ?>",
						type: "POST",
						data: {
							table : t_table,
							coloum : t_coloum,
							tn : t_tn,
							html : elem_html,
							t_date : p_date
						},
						cache: false,
						success: function(data) {	
						//	alert("suc");
						},
						error: function(request,status,error){
							alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error); 				
						},
					})
					
				}
			});

			var pickOrNot = 1;
			for(var i=1; i<=items.length; i++)
			{
				if(items.get(i).group == "0" && items.get(i).start == p_date){
					pickOrNot = 0;
					break;
					
				}
			}
			if(pickOrNot == 1){
				items.add({id: items.length+1, group: 0, content: '<span data-target="#chart_insert" data-toggle="modal" onclick="chart_list(\'' + p_date + '\')">CHART</span>', start: p_date});
				//timeline.fit();
			}
		}

		function chart_list(t_date)
		{
			if(t_date=="0"){
				var date = new Date(); 
				var year = date.getFullYear(); 
				var month = new String(date.getMonth()+1); 
				var day = new String(date.getDate()); 

				if(month.length == 1){ 
				  month = "0" + month; 
				} 
				if(day.length == 1){ 
				  day = "0" + day; 
				} 

				t_date = year + "-" + month + "-" + day;
			}

			//alert(t_date);

			$("#tab_list").html("");
			$("#tab_list").html("");
			var html_tab = "";
			var html_content = "";			
			var doc_1 = doc.childNodes[0].childNodes;
			var html_content_ex = "";
			for(var i=0; i<doc_1.length; i++)
			{
				var tagName = doc_1[i].tagName;
				if(typeof(tagName) != "undefined"){
					if(i==1){
						html_tab = html_tab + "<li role='presentation' class='active'><a href='#" + tagName + "' aria-controls='" + tagName + "' role='tab' data-toggle='tab'>" + tagName + "</a></li>";
					}else{
						html_tab = html_tab + "<li role='presentation'><a href='#" + tagName + "' aria-controls='" + tagName + "' role='tab' data-toggle='tab'>" + tagName + "</a></li>";
					}						
				

					var doc_2 = doc_1[i].childNodes;

					if(typeof(tagName) != "undefined"){
						if(i==1){
							html_content = html_content + "<div role='tabpanel' class='row tab-pane fade in active' id='" + tagName + "'>";
							html_content = html_content +	"<div class='col-md-12'>";
							html_content = html_content +		"<table class='table table-bordered table-hover table-condensed' style='text-align:center;'>";
							html_content = html_content +			"<tbody>";
						}else{
							html_content = html_content + "<div role='tabpanel' class='row tab-pane fade' id='" + tagName + "'>";
							html_content = html_content +	"<div class='col-md-12'>";
							html_content = html_content +		"<table class='table table-bordered table-hover table-condensed' style='text-align:center;'>";
							html_content = html_content +			"<tbody>";
						}						
					}

					for(var j=0; j<doc_2.length; j++)
					{
						var tagName_1 = doc_2[j].tagName;
						if(typeof(tagName_1) != "undefined"){	
							html_content = html_content + "<tr>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 18'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 17'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 16'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 15'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 14'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 13'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 12'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 11'></td>";
							html_content = html_content +	"<td>" + tagName_1 + "</td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 21'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 22'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 23'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 24'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 25'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 26'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 27'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 28'></td>";
							html_content = html_content + "</tr>";
						}
					}

					html_content = html_content + "<tr class='info'>";
					html_content = html_content +	"<td>18</td>";
					html_content = html_content +	"<td>17</td>";
					html_content = html_content +	"<td>16</td>";
					html_content = html_content +	"<td>15</td>";
					html_content = html_content +	"<td>14</td>";
					html_content = html_content +	"<td>13</td>";
					html_content = html_content +	"<td>12</td>";
					html_content = html_content +	"<td>11</td>";
					html_content = html_content +	"<td></td>";
					html_content = html_content +	"<td>21</td>";
					html_content = html_content +	"<td>22</td>";
					html_content = html_content +	"<td>23</td>";
					html_content = html_content +	"<td>24</td>";
					html_content = html_content +	"<td>25</td>";
					html_content = html_content +	"<td>26</td>";
					html_content = html_content +	"<td>27</td>";
					html_content = html_content +	"<td>28</td>";
					html_content = html_content + "</tr>";
					html_content = html_content + "<tr class='info'>";
					html_content = html_content +	"<td>48</td>";
					html_content = html_content +	"<td>47</td>";
					html_content = html_content +	"<td>46</td>";
					html_content = html_content +	"<td>45</td>";
					html_content = html_content +	"<td>44</td>";
					html_content = html_content +	"<td>43</td>";
					html_content = html_content +	"<td>42</td>";
					html_content = html_content +	"<td>41</td>";
					html_content = html_content +	"<td></td>";
					html_content = html_content +	"<td>31</td>";
					html_content = html_content +	"<td>32</td>";
					html_content = html_content +	"<td>33</td>";
					html_content = html_content +	"<td>34</td>";
					html_content = html_content +	"<td>35</td>";
					html_content = html_content +	"<td>36</td>";
					html_content = html_content +	"<td>37</td>";
					html_content = html_content +	"<td>38</td>";
					html_content = html_content + "</tr>";

					for(var j=doc_2.length - 1; j>=0; j--)
					{
						var tagName_1 = doc_2[j].tagName;
						if(typeof(tagName_1) != "undefined"){
							html_content = html_content + "<tr>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 48'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 47'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 46'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 45'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 44'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 43'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 42'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 41'></td>";
							html_content = html_content +	"<td>" + tagName_1 + "</td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 31'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 32'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 33'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 34'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 35'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 36'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 37'></td>";
							html_content = html_content +	"<td onclick='incrementValue(this, \"" + tagName + "\", \"" + tagName_1 + "\")' class='chart " + tagName + " " + tagName_1 + " 38'></td>";
							html_content = html_content + "</tr>";
						}
					}
					
					html_content = html_content +			"</tbody>";
					html_content = html_content +		"</table>";
					html_content = html_content +	"</div>";
					html_content = html_content + "</div>";
				}
				
			}

			$("#tab_list").html(html_tab);
			$("#content_list").html(html_content);
			$("#test_dmf").html('<a class="btn btn-default" data-dismiss="modal">Close</a><a class="btn btn-primary" onclick="test_dmf(\'' + t_date + '\')">Save changes</a>');		


			// chart 내용 

			$.ajax({
				url: "<?php echo site_url("dentist/get_chart/$p_idx") ?>",
				type: "POST",
				data: {
					folder_name : t_date
				},
				cache: false,
				dataType: 'json',
				success: function(data) {	
						$.each(data, function(key, value) {
							document.getElementsByClassName(key)[0].innerHTML = value;
						});
				},
				error: function(request,status,error){
				 	alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error); 				
				},
			})

		}


	// xml 파싱 함수



	var xmlDoc;  //xml DOM

	function getXmlObj()
	{
		var xmlhttp = null;

		// Mozilla/Safari
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}
		else if (window.ActiveXObject) {// IE
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		return xmlhttp;
	}

	function getXMLDom(pUrl,pOption,pSearchValue)
	{
		var xmlhttp = getXmlObj(); 
		var templateStr = null;
		var pAsync = false;

		if (pOption == "TRUE")
		{
			pAsync = true;
		}

		if (pOption == "POST")
		{
			xmlhttp.open("POST",pUrl,pAsync);
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		}
		else
		{
			xmlhttp.open("GET",pUrl,pAsync);

		}
		xmlhttp.onreadystatechange = function () {

			if(xmlhttp.readyState == "4")
			{
				xmlDoc = xmlhttp.responseXML;
			}

		}

		xmlhttp.send(); 
		return xmlDoc;
	}

	function getDomLength(pName,pDom)
	{
		try
		{
			return pDom.getElementsByTagName(pName).length;
		}
		catch (e)
		{
			return xmlDoc.getElementsByTagName(pName).length;
		}
	}

	function getValue(pName,pIndex,pAttr)
	{
		if (typeof pIndex == "undefined" || pIndex =="")
		{
			pIndex = 0;
		}

		x = xmlDoc.getElementsByTagName(pName);

		if (typeof pAttr == "undefined" || pAttr =="")
		{
			if(x[pIndex].hasChildNodes())
			{
				v = x[pIndex].childNodes[0].nodeValue;
			}
			else
			{
				v = "";
			}
		}
		else
		{
			v = x[pIndex].getAttribute(pAttr);
		}

		return v;
	}


	function getXMLText(pCode,pValue)
	{
		var xDom = getXMLDom('code_test.xml');  
		var cnt = getDomLength(pCode,xDom);
		var strHTML = ""  ;
		for(var i=0;i<cnt;i++)
		{
			if(getValue(pCode,i,"code") == pValue)
				strHTML = getValue(pCode,i,"text");
			}
		return strHTML;
	}



	</script>