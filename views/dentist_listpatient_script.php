<script src="<?php echo base_url(); ?>script/vis/dist/vis.js"></script>

<style type="text/css">
	.blue {
	  fill:blue;
	}
</style>

<script>		
/*
	// ajax!!! 가 필요해!

	// DOM element where the Timeline will be attached
	var container = document.getElementById('patientlist_timeline');

	// create a data set with groups // 그룹의 목록은 DB가 결정된 후 뽑도록. 예) 상품, 치료, 치료방법 등을 그룹으로 선정 후 통계를 돌리자!
	
	// visjs로는 kaplan meier의 중도절단 그래프를 그릴 수 없음. 따라서 d3js로 가는 것이 바람직함, 오로지 환자의 리스트를 표현하는데는 적절할 듯함.
	// 수직스크롤이 되지않아 많은 환자가 있을 경우가 걱정됨
	// 직선에 사람이름과 내원일을 점찍을 것인가?
	// 환자 하나 생성에 하나의 그룹을 만들어야 한다는 단점. 그룹이 많아지면 느려지지 않는가?
	// 더미 데이터가 꼭 필요한 상황
	
	
	// 기존의 자료는 old로 남김 2017.8.1 16:41
	// 1000개의 환자가 생길경우 매우 느려짐

*/


	// 그릴 준비하기
    var container = document.getElementById('patientlist_timeline');

    // create a dataSet with groups 데이터세트 준비.
    // 그룹 하나가 직선하나를 그릴수 밖에 없으므로, 그룹을 다량생성
    var groups = new vis.DataSet();
	var items = new vis.DataSet();    		// 타임라인은 아이템으로
  	
	// 환자 관련 날자 랜덤 모의 생성
  	var start = new Date(2000, 01, 01);
  	var end = new Date(2018, 01, 01);
  	
  	// 100개 환자 랜덤 생성
	/*
	for (var i = 0; i < 500; i++) {
		groups.add({ id: i, content: "정"+ i +"교" });	
        items.add([
        	{
        	id: i, 
        	group: i, 
        	start: new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime())),   // 환자가 처음 초진받은 날
        	end: new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime())),		// 환자가 가장 마지막으로 수복물 검사한 날
        	content: 'item ' + i + ' <span style="color:#97B0F8;">( 정' + i + '교 )</span>',
        	},
        	
        	{
        	id: i + 'A', 
        	group: i, 
        	start: new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime())),   // 환자가 태어난 날
        	end: new Date(), 	// 환자가 병원에 마지막 온날
        	content: 'Period ' + i + 'A ( 정' + i + '교 )',
        	type: 'background'
        	}
        	
        	]      	
        );
    };
	*/

	$.get("<?php echo site_url("dentist/listpatients") ?>", function(data) {
		// if any files already in server show all here
		if (data.length > 0) {
			$.each(data, function(key, value) {
				var mockFile = value;

				groups.add({ id: groups.length+1, content: '<a href="/dentist/timeline/' + value.idx + '">' + value.lastname + value.firstname + '</a>' });
				//items.add({id: items.length+1, group:  groups.length, content: '<a href="/dentist/timeline/' + value.idx + '">' + value.folder_name + '~</a>', start: value.folder_name, end: new Date(new Date().getTime())});
				if(value.start_date == null) value.start_date = value.folder_name;
				if(value.end_date == null) value.end_date = value.folder_name;
				items.add({id: items.length+1, group:  groups.length, start: value.start_date, end: value.end_date});
				
			});
		}
	});

// 그려지는 창의 모습
    var options = { 
		min: "2000-01-01",
		max: new Date(new Date().getTime()+(365*24*60*60*1000)),

        start: "2000-01-01",  // 보여줄 x축 폭
        end: "2018-01-01",
        editable: false,
        // stack: false,
        // stackSubgroups: false,
        
		stack: true,
        verticalScroll : true,
		zoomKey: 'ctrlKey',
		zoomMin: 600000*60*60*7,
		maxHeight: 600,
		editable: false,
		margin: {
		  item: 10, // minimal margin between items
		  axis: 5   // minimal margin between items and the axis
		},
		orientation: 'top'
    };
    
    var timeline = new vis.Timeline(container);
    timeline.setOptions(options);
  	timeline.setGroups(groups);
  	timeline.setItems(items);
	

</script>