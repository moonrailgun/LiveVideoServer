<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
  <a data-toggle="collapse" data-target="#search"  href="#" title="检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
  <a data-toggle="collapse" data-target="#add"  href="#" title="添加"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-plus"></i></button></a>
</div>



<{if !$_GET.search }>
<div id="search" class="collapse in">
<{else }>
<div id="search" class="collapse out">
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
</div>

<div id="add" class="collapse out">
<form class="form_search"  action="item_available_add.php" method="POST" style="margin-bottom:0px">
  <input type="hidden" name="add" value="1"/>
  <input type="hidden" id="_actor_id" name="actor_id" value=""/>
  <div style="float:left;margin-right:5px">
		<label>道具</label>
    <select id="item_id" name="item_id" class="input-xlarge">
      <{html_options options=$item_id_list selected=$_GET.item_id}>
    </select>
	</div>
  <div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
    <button type="submit" class="btn btn-primary">添加可用道具</button>
  </div>
  <div style="clear:both;"></div>
</form>
<script>
$('#actor_id').change(function(){
  console.log("a");
  $('#_actor_id').val($(this).val());
})
</script>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">道具可用性</a>
  <div id="page-stats" class="block-body collapse in">
    <div id="modify">
      <form class="form_search"  action="item_available_add.php" method="POST" style="margin-bottom:0px">
        <input type="hidden" id="_actor_id" name="actor_id" value=""/>
        <div style="float:left;margin-right:5px">
          <select id="item_state" name="item_state" class="input-xlarge">
            <{html_options options=$item_state_list selected=$_GET.item_state}>
          </select>
      	</div>
        <div class="btn-toolbar" style="padding-bottom:0px;margin-bottom:0px">
          <button type="submit" class="btn btn-primary">修改</button>
        </div>
        <div style="clear:both;"></div>
      </form>
    </div>
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
        <td><{$data.user_id}></td>
        <td><{$data.tool_name}></td>
        <td><{$item_state_list[$data.state]}></td>
        <td><input type="checkbox" name="select_ids[]" value="<{$data.id}>" style="margin-top:-4px;margin-left:6px;"></td>
        <td>
          <a href="item_available_modify.php?id=<{$data.id}>" title= "修改" >修改</a>
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
