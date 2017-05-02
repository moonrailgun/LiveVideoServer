<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="item_available_add.php" class="btn btn-primary"><i class="icon-plus"></i> 添加可用道具</a>
    <a data-toggle="collapse" data-target="#search"  href="#" title="检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>

<{if $_GET.search }>
<div id="search" class="collapse in">
<{else }>
<div id="search" class="collapse out" >
<{/if }>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
  <input type="hidden" name="search" value="1" >
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
	<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">检索</button>
	</div>
	<div style="clear:both;"></div>
</form>
</div>
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
      $(actor_id).html(html);
    })
  }else{
    $(actor_id).html('');
  }
}

$('#website_id').change(tryUpdateActorList);
$('#group_id').change(tryUpdateActorList);
</script>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">礼物库</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>平台</th>
        <th>工会</th>
        <th>主播</th>
        <th>道具名称</th>
        <th>道具状态</th>
        <th>选择</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=data from=$data_list item=data}>
      <tr>
        <td><{$website_id_list[$data.website_id]}></td>
        <td><{$group_id_list[$data.group_id]}></td>
        <td><{$data.actor}></td>
        <td><{$data.item_name}></td>
        <td><{$data.item_state}></td>
        <td><{$data.item_state}></td>
        <input type="checkbox" name="select_ids[]" value="<{$data.id}>" checked="checked">
        <td>
          <a href="item_available_modify.php?id=<{$data.id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="item_available_delete.php?id=<{$data.id}>"></i></a>
        </td>
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
