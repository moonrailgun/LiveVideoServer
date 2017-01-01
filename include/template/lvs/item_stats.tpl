<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<script src="<{$smarty.const.ADMIN_URL}>/assets/lib/Chart.js/Chart.min.js"></script>

<div style="border:0px;padding-bottom:5px;height:auto">
	<form action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
		<label>请选择视频网站</label>
		<{html_options name="website_id" options=$website_id_list selected=$_GET.website_id}>
	</div>
	<div style="float:left;margin-right:5px">
		<label>选择起始时间</label>
		<input type="text" id="start_date" name="start_date" value="<{$_GET.start_date}>" placeholder="起始时间" >
	</div>
	<div style="float:left;margin-right:5px">
		<label>选择结束时间</label>
		<input type="text" id="end_date" name="end_date" value="<{$_GET.end_date}>" placeholder="结束时间" >
	</div>
  <{if $show_actor_options}>
  <div style="float:left;margin-right:5px">
    <label>请选择主播 <span class="label label-info">可以为空</span></label>
    <{html_options name="actor_id" options=$actor_id_list selected=$_GET.actor_id}>
  </div>
  <{/if}>
	<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
	   <button type="submit" class="btn btn-primary"><strong>检索</strong></button>
	</div>
	<div style="clear:both;"></div>
	</form>
</div>

<div class="well">
    <ul class="nav nav-tabs">
			<li class="active"><a href="#tab_actor" data-toggle="tab">按主播总价值排序</a></li>
			<li><a href="#tab_item_cost" data-toggle="tab">按道具总发送排序</a></li>
      <li><a href="#tab_player_cost" data-toggle="tab">按玩家总消费排序</a></li>
      <li><a href="#tab_time" data-toggle="tab">按时间轴排序</a></li>
      <li><a href="#tab_detail" data-toggle="tab">消费明细</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div id="tab_actor" class="tab-pane active in">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width:80px">主播名</th>
              <th style="width:100px">消费额(虚拟币)/次数</th>
              <th style="width:50px">排名</th>
            </tr>
          </thead>
          <tbody>
            <{foreach name=actor_worth from=$tab_actor_data item=actor_worth_info}>
            <tr>
              <td><{$actor_worth_info.actor_nick_name}></td>
              <td><{$actor_worth_info.actor_cost}>/<{$actor_worth_info.actor_cost_amount}></td>
              <td><{$smarty.foreach.actor_worth.index + 1}></td>
            </tr>
            <{/foreach}>
          </tbody>
        </table>
      </div>
    	<div id="tab_item_cost" class="tab-pane fade">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width:80px">道具名称</th>
              <th style="width:100px">消费额(虚拟币)/次数</th>
              <th style="width:50px">排名</th>
            </tr>
          </thead>
          <tbody>
            <{foreach name=item_worth from=$tab_item_data item=item_worth_info}>
            <tr>
              <td><{$item_worth_info.item_name}></td>
              <td><{$item_worth_info.item_cost}>/<{$item_worth_info.item_cost_amount}></td>
              <td><{$smarty.foreach.item_worth.index + 1}></td>
            </tr>
            <{/foreach}>
          </tbody>
        </table>
    	</div>
      <div id="tab_player_cost" class="tab-pane fade">
        <div style="float:left;margin-right:5px">
          <label>玩家：</label>
          <input id="filter_player_name" type="text"  class="input-xlarge" onchange="filterData()" onKeyUp="filterData()"/>
        </div>
        <div style="float:left;margin-right:5px">
          <label>道具：</label>
          <select id="filter_tool_name" class="input-xlarge" onchange="filterData()">
						<option value="all" selected="selected">全部</option>
            <{html_options options=$item_id_list}>
          </select>
        </div>
        <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
          <a type="submit" onclick="clearFilter();" class="btn btn-primary"><strong>清空条件</strong></a>
        </div>
        <div style="clear:both;"></div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width:40px">#</th>
              <th style="width:180px">网站</th>
              <th style="width:100px">主播</th>
              <th style="width:200px">发送时间</th>
              <th style="width:100px">道具名称</th>
              <th style="width:60px">道具单价</th>
              <th style="width:100px">玩家名</th>
            </tr>
          </thead>
          <tbody>
            <{foreach name=player_cost from=$tab_detail_data item=detail_item}>
            <tr class="player_cost_row">
              <td><{$smarty.foreach.player_cost.index + 1}></td>
              <td><{$website_name}></td>
              <td><{$actor_name}></td>
              <td><{$detail_item.createdDate}></td>
              <td class="player_cost_tool_name"><{$detail_item.toolName}></td>
              <td><{$detail_item.totalCost/$detail_item.totalAmount}></td>
              <td class="player_cost_player_name"><{$detail_item.playerName}></td>
            </tr>
            <{/foreach}>
          </tbody>
        </table>
    	</div>
      <div id="tab_time" class="tab-pane fade">
				<div style="">
			    <label>道具:</label>
			    <select id="chartSelect">
						<option value="all" selected="selected">全部</option>
						<{html_options options=$item_id_list}>
					</select>
					<!-- <label>道具消费金额</label> -->
					<canvas id="cost_chart" style="width:90%;height:400px"></canvas>
			  </div>
    	</div>
      <div id="tab_detail" class="tab-pane fade">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width:80px">#</th>
              <th style="width:100px">玩家名称</th>
              <th style="width:50px">消费额(虚拟币)</th>
            </tr>
          </thead>
          <tbody>
            <{foreach name=detail from=$tab_detail_data item=detail_item}>
            <tr>
              <td><{$smarty.foreach.detail.index + 1}></td>
              <td><{$detail_item.playerName}></td>
              <td><{$detail_item.totalCost}></td>
            </tr>
            <{/foreach}>
          </tbody>
        </table>
    	</div>
    </div>
</div>

<script>
$(function() {
	var date=$("#start_date");
	date.datepicker({dateFormat: "yy-mm-dd"});
	date.datepicker("option", "firstDay", 1 );
});
$(function() {
	var date=$( "#end_date" );
	date.datepicker({dateFormat: "yy-mm-dd"});
	date.datepicker("option", "firstDay", 1 );
});

function filterData(){
  var filter_player_name = $('#filter_player_name').val();
  var filter_tool_name = $('#filter_tool_name').find("option:selected").text().trim();

  if(filter_player_name == "" && filter_tool_name == "全部"){
    $('.player_cost_row').show();
  }else{
		var show_list = [];
		var hide_list = [];

    $('.player_cost_row').each(function(){
      var obj = $(this);
			var player_name = obj.children('.player_cost_player_name').text();
			var tool_name = obj.children('.player_cost_tool_name').text();
			if(filter_player_name!=""&&filter_tool_name!="全部"){
				if(player_name.indexOf(filter_player_name)>=0&&tool_name.indexOf(filter_tool_name)>=0){
					show_list.push(obj);
				}else{
					hide_list.push(obj);
				}
			}else if(filter_player_name!=""){
				if(player_name.indexOf(filter_player_name)>=0){
					show_list.push(obj);
				}else{
					hide_list.push(obj);
				}
			}else if(filter_tool_name!=""){
				if(tool_name.indexOf(filter_tool_name)>=0){
					show_list.push(obj);
				}else{
					hide_list.push(obj);
				}
			}

			for(var i=0;i<show_list.length;i++){
				show_list[i].show();
			}
			for(var i=0;i<hide_list.length;i++){
				hide_list[i].hide();
			}
		});
  }
}

function clearFilter(){
  $('#filter_player_name').val("");
  $('#filter_tool_name').val("all");
  $('.player_cost_row').show();
}

$(function(){
	var tab_time_data = '<{$tab_time_data}>';
	tab_time_data = JSON.parse(tab_time_data);
	// console.log(tab_time_data);

	if(tab_time_data){
		var labelArray = [];
		var dataArray = [];
		$.each(tab_time_data, function(idx, obj) {
			labelArray.push(idx);
			dataArray.push(obj['total_cost']);
		});
		// console.log(labelArray);

		var ctx = $("#cost_chart").get(0).getContext("2d");
		var config = {
			type: 'line',
			data:{
				labels:labelArray,
				datasets:[{
					label: "总消费",
					fill: false,
					backgroundColor: "rgb(54, 162, 235)",
					borderColor: "rgb(54, 162, 235)",
					data: dataArray
				}]
			},
			options: {
					responsive: true,
					title:{
							display:true,
							text:'道具消费金额'
					},
					tooltips: {
							mode: 'index',
							intersect: false,
					},
					hover: {
							mode: 'nearest',
							intersect: true
					}
			}
		}
		var myNewChart = new Chart(ctx, config);
	}

	//绑定事件
	$('#chartSelect').change(function(){
		var value = $('#chartSelect').find("option:selected").text();
		if(value == "全部"){
			config.data.datasets.splice(1,1);
		}else{
			var newDataArray = [];
			$.each(tab_time_data, function(idx, obj) {
				newDataArray.push(obj[value] || 0);
			});
			if(config.data.datasets.length != 1){
				//删除之前的
				config.data.datasets.splice(1,1);
			}
			config.data.datasets.push({
				label: value,
				fill: false,
				backgroundColor: "rgb(255, 99, 132)",
				borderColor: "rgb(255, 99, 132)",
				data: newDataArray
			});
			console.log(dataArray);
			console.log(newDataArray);
		}


		myNewChart.update();
	})
})
</script>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
