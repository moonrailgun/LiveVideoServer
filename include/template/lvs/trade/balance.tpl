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
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">充值信息</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:120px">主播</th>
        <th style="width:120px">虚拟币余额</th>
        <th style="width:120px">修正值</th>
        <th style="width:120px">操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=data from=$actor_list item=data}>
      <tr>
        <td><{$data.real_name}>(<{$data.user_id}>)</td>
        <td><{$data.currency_count}></td>
        <td><input type="text" value="<{$data.currency_count}>" class="input-xlarge" /></td>
        <td><a href="javascript:;" title= "修改" data-id="<{$data.id}>" ><i class="icon-pencil"></i></a></td>
      </tr>
      <{/foreach}>
    </tbody>
  </table>
  </div>
</div>
<script>
$('table > tbody a').click(function() {
  var currency_count = $(this).parent().parent().find('input').val();
  var actor_id = $(this).data('id');

  location.href = "balance_modify.php?actor_id="+actor_id+"&balance="+currency_count;
});
</script>

<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
