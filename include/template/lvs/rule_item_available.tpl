<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="rule_item_available_add.php" class="btn btn-primary"><i class="icon-plus"></i> 规则</a>
</div>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">道具可用性规则列表</a>
    <div id="page-stats" class="block-body collapse in">
    <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:80px">视频网名称</th>
        <th style="width:100px">主播名称</th>
        <th style="width:100px">设备编号</th>
        <th style="width:100px">设备状态</th>
        <th style="width:100px">道具名称</th>
        <th style="width:100px">道具状态</th>
        <th style="width:80px">操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=rule_item_available from=$rule_list item=rule_info}>
      <tr>
        <td><{$website_id_list[$rule_info.website_id]}></td>
        <td><{$actor_id_list[$rule_info.website_id][$rule_info.actor_id]}></td>
        <td><{$rule_info.machine_id}></td>
        <td><{$status_list[$rule_info.machine_status]}></td>
        <td><{$item_id_list[$rule_info.item_id]}></td>
        <td><{$status_list[$rule_info.item_status]}></td>
        <td>
          <a href="rule_item_available_modify.php?rule_id=<{$rule_info.id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="rule_item_available.php?page_no=<{$page_no}>&method=del&rule_id=<{$rule_info.id}>"></i></a>
        </td>
      </tr>
      <{/foreach}>
    </tbody>
  </table>
  <!--- START 分页模板 --->
         <{$page_html}>
   <!--- END --->
    </div>
</div>



<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
