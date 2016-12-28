<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

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
</script>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
