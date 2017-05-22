<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<script src="<{$smarty.const.ADMIN_URL}>/assets/lib/Chart.js/Chart.min.js"></script>

<div id="search" class="collapse in">
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
  <input type="hidden" name="search" value="1" >
	<div style="float:left;margin-right:5px">
    <label>工会</label>
    <select id="group_id" name="group_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$group_id_list selected=$_GET.group_id}>
    </select>
    <label>道具</label>
    <select id="item_id" name="item_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$item_id_list selected=$_GET.item_id}>
    </select>
    <label>排名条件</label>
    <select id="analysis_by" name="analysis_by" class="input-xlarge">
      <option value="totalCost">虚拟币</option>
      <option value="totalAmount">次数</option>
    </select>
    <label>起止日期</label>
    <input type="text" id="start_date" name="start_date" value="<{$_GET.start_date}>" placeholder="起始时间" >
    <input type="text" id="end_date" name="end_date" value="<{$_GET.end_date}>" placeholder="结束时间" >
    <div class="btn-toolbar" style="padding-top:0;padding-bottom:0;margin-bottom:0">
      <button type="submit" class="btn btn-primary">检索</button>
    </div>
  </div>
	<div style="clear:both;"></div>
</form>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">道具粘性</a>
  <div id="page-stats" class="block-body collapse in">
    <div style="width:75%;">
      <canvas id="canvas"></canvas>
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
$(function() {
  $('#analysis_by').val("<{$_GET.analysis_by}>");
});
</script>
<script>
var loyaltyData = JSON.parse('<{json_encode($loyalty_data)}>');
var labels = [];
var datas = [];

for (var key in loyaltyData) {
  if (loyaltyData.hasOwnProperty(key)) {
    labels.push(key);
    datas.push(loyaltyData[key]);
  }
}

console.log(labels, datas);
var myLineChart = new Chart($('#canvas'), {
  type: 'line',
  data: {
    labels: labels,
    datasets: [{
      label: '<{($_GET.analysis_by==totalCost)?"虚拟币":"次数"}>',
      data: datas,
      backgroundColor: '#d5f0ff',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero:true
        }
      }]
    }
  }
});
</script>

<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
