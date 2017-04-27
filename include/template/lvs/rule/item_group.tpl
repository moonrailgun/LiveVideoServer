<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="item_group_add.php" class="btn btn-primary"><i class="icon-plus"></i> 道具组</a>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">道具组列表</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:140px">组别名称</th>
        <th style="width:80px">操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=group from=$item_group_list item=group}>
      <tr>
        <td><{$group.group_name}></td>
        <td>
          <a href="item.php?group_id=<{$group.id}>" title= "编辑" ><i class="icon-list-alt"></i></a>
          <a href="item_group_modify.php?group_id=<{$group.id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="item_group_delete.php?group_id=<{$group.id}>" ></i></a>
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
