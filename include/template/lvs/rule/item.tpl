<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="item_add.php" class="btn btn-primary"><i class="icon-plus"></i> 道具</a>
    <a data-toggle="collapse" data-target="#search" href="#" title="检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>

<{if $_GET.search }>
<div id="search" class="collapse in">
<{else }>
<div id="search" class="collapse out" >
<{/if }>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
  <input type="hidden" name="search" value="1" >
	<div style="float:left;margin-right:5px">
		<label>组别</label>
    <select id="group_id" name="group_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$item_group_id_list selected=$_GET.group_id}>
    </select>
	</div>
	<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">检索</button>
	</div>
	<div style="clear:both;"></div>
</form>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">道具库</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>组别</th>
        <th>道具名称</th>
        <th>道具指令</th>
        <th>标识</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=item_info from=$item_list item=item_info}>
      <tr>
        <td><{$item_group_id_list[$item_info.tool_type_id]}></td>
        <td><{$item_info.tool_name}></td>
        <td><{$item_info.tool_direct}></td>
        <td><{$queue_flag_list[$item_info.queue_flag]}></td>
        <td>
          <a href="item_modify.php?id=<{$item_info.id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="item_delete.php?id=<{$item_info.id}>"></i></a>
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
