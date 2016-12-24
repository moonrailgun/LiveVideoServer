<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">道具消费记录</a>
    <div id="page-stats" class="block-body collapse in">
    <table class="table table-striped">
    <thead>
      <tr>
			<th style="width:40px">#</th>
			<th style="width:80px">主播ID</th>
			<th style="width:100px">主播名</th>
			<th style="width:100px">观众ID</th>
			<th style="width:80px">观众名</th>
			<th style="width:80px">道具名</th>
			<th style="width:80px">道具类型</th>
			<th style="width:60px">总消费</th>
			<th style="width:60px">总数量</th>
			<th style="width:80px">操作日期</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=item from=$item_logs item=item_log}>
			<tr>
			<td><{$item_log.id}></td>
			<td><{$item_log.actorID}></td>
			<td><{$item_log.actorName}></td>
			<td><{$item_log.playerID}></td>
			<td><{$item_log.playerName}></td>
			<td><{$item_log.toolName}></td>
			<td><{$item_log.toolTypeName}></td>
			<td><{$item_log.totalCost}></td>
			<td><{$item_log.totalAmount}></td>
      <td><{$item_log.createdDate}></td>
			</tr>
      <{/foreach}>
      </tbody>
    </table>
		<!--- START 分页模板 --->
           <{$page_html}>
	   <!--- END --->
    </div>
</div>

<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<{include file="footer.tpl"}>
