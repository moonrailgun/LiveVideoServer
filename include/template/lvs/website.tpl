<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">网站列表</a>
    <div id="page-stats" class="block-body collapse in">
    <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:40px">#</th>
        <th style="width:80px">视频网名称</th>
        <th style="width:100px">视频网缩写</th>
        <th style="width:100px">视频网描述</th>
        <th style="width:80px">操作</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=website from=$website_list item=website_info}>
      <tr>
        <td><{$website_info.website_id}></td>
        <td><{$website_info.website_name}></td>
        <td><{$website_info.website_short_name}></td>
        <td><{$website_info.website_desc}></td>
        <td>
          <a href="website_modify.php?website_id=<{$website_info.website_id}>" title= "修改" ><i class="icon-pencil"></i></a>
          <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="website.php?page_no=<{$page_no}>&method=del&website_id=<{$website_info.website_id}>" ></i></a>
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
