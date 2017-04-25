<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
  <a href="actor_add.php" class="btn btn-primary"><i class="icon-plus"></i> 主播</a>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">主播列表</a>
  <div id="page-stats" class="block-body collapse in">
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:120px">登录名</th>
        <th style="width:120px">姓名</th>
        <th style="width:120px">直播ID</th>
        <th style="width:120px">平台</th>
        <th style="width:120px">工会</th>
        <th style="width:80px">操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=actor from=$actor_list item=actor}>
      <tr>
        <td><{$actor.user_id}></td>
        <td><{$actor.real_name}></td>
        <td><{$actor.live_id}></td>
        <td><{$website_id_list[$actor.website_id]}></td>
        <td><{$group_id_list[$actor.group_id]}></td>
        <td>
          <a href="actor_modify.php?actor_id=<{$actor.id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="actor_delete.php?actor_id=<{$actor.id}>" ></i></a>
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
