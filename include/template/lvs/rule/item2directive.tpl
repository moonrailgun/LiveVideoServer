<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="item2directive_add.php" class="btn btn-primary"><i class="icon-plus"></i> 规则</a>
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
	<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">检索</button>
	</div>
	<div style="clear:both;"></div>
</form>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">礼物库</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>平台</th>
        <th>指令名称</th>
        <th>道具名称</th>
        <th>指令地址</th>
        <th>命令</th>
        <th>参数</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=data from=$data_list item=data}>
      <tr>
        <td><{$website_id_list[$data.website_id]}></td>
        <td><{$data.tool_direct}></td>
        <td><{$data.tool_name}></td>
        <td><{$data.address}></td>
        <td><{$data.command}></td>
        <td><{$data.param}></td>
        <td>
          <a href="item2directive_modify.php?id=<{$data.id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="item2directive_delete.php?id=<{$data.id}>"></i></a>
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
