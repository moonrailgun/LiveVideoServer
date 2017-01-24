<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="actor_add.php" class="btn btn-primary"><i class="icon-plus"></i> 客户</a>
</div>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">客户信息维护</a>
    <div id="page-stats" class="block-body collapse in">
    <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:80px">客户昵称</th>
        <th style="width:100px">视频网站</th>
        <th style="width:100px">客户联系电话</th>
        <th style="width:100px">客户真实姓名</th>
        <th style="width:100px">生成的用户名</th>
        <th style="width:80px">操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=actor from=$actor_list item=actor}>
      <tr>
        <td><{$actor.actor_nick_name}></td>
        <td><{$actor.actor_website}></td>
        <td><{$actor.actor_phone}></td>
        <td><{$actor.actor_real_name}></td>
        <td><{$actor.actor_generated_name}></td>
        <td>
          <a href="actor_modify.php?actor_id=<{$actor.actor_id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "重置密码" ><i class="icon-repeat" href="actor.php?page_no=<{$page_no}>&method=reset_password&actor_id=<{$actor.actor_id}>" ></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="actor.php?page_no=<{$page_no}>&method=del&actor_id=<{$actor.actor_id}>" ></i></a>
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
