<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
  <a data-toggle="collapse" data-target="#search"  href="#" title="检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>

<{if $_GET.search }>
<div id="search" class="collapse in">
<{else }>
<div id="search" class="collapse out">
<{/if }>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
		<label>平台</label>
    <select id="website_id" name="website_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$website_id_list selected=$_GET.website_id}>
    </select>
	</div>
	<div style="float:left;margin-right:5px">
		<label>工会</label>
    <select id="group_id" name="group_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$group_id_list selected=$_GET.group_id}>
    </select>
	</div>
	<div style="float:left;margin-right:5px">
		<label>主播</label>
    <select id="actor_id" name="actor_id" class="input-xlarge">
    </select>
	</div>
	<div style="clear:both;"></div>
  <label>起止日期</label>
  <input type="text" id="start_date" name="start_date" value="<{$_GET.start_date}>" placeholder="起始时间" >
  <input type="text" id="end_date" name="end_date" value="<{$_GET.end_date}>" placeholder="结束时间" >
  <div class="btn-toolbar" style="padding-top:0;padding-bottom:0;margin-bottom:0">
    <button type="submit" class="btn btn-primary">检索</button>
  </div>
</form>
<script>
var tryUpdateActorList = function() {
  var website_id = $('#website_id').val()
  var group_id = $('#group_id').val()

  if(website_id && group_id){
    $.get('/api/actor.php', {website_id:website_id,group_id:group_id}, function(dat) {
      var html = '';
      for (var i = 0; i < dat.length; i++) {
        var item = dat[i];
        html += '<option value="'+item['id']+'">'+item['real_name']+'('+item['user_id']+')'+'</option>';
      }
      $('#actor_id').html(html).change();
    })
  }else{
    $('#actor_id').html('').change();
  }
}

$('#website_id').change(tryUpdateActorList);
$('#group_id').change(tryUpdateActorList);
</script>
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
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">充值信息</a>
  <div id="page-stats" class="block-body collapse in">
  <p>消费虚拟币总计：<{$data_count[0]}></p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:120px">主播</th>
        <th style="width:120px">工会</th>
        <th style="width:120px">平台</th>
        <th style="width:120px">消费时间</th>
        <th style="width:120px">消费虚拟币</th>
        <th style="width:120px">消费道具</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=data from=$data_list item=data}>
      <tr>
        <td><{$data.user_id}></td>
        <td><{$website_id_list[$data.website_id]}></td>
        <td><{$group_id_list[$data.group_id]}></td>
        <td><{$data.createdDate}></td>
        <td><{$data.totalCost}></td>
        <td><{$data.toolName}></td>
      </tr>
      <{/foreach}>
    </tbody>
  </table>
  </div>
</div>

<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
