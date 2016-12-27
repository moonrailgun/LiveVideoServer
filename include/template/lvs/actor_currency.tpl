<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<select name="website_id" onchange="javascript:location.replace('actor_currency.php?website_id='+this.options[this.selectedIndex].value)" style="margin:5px 0px 0px">
	<{html_options options=$website_id_list selected=$website_id}>
</select>

<div class="block">
    <a href="#page-stats" class="block-heading" data-toggle="collapse">客户账户信息</a>
    <div id="page-stats" class="block-body collapse in">
    <table class="table table-striped">
    <thead>
      <tr>
        <th style="width:80px">主播</th>
        <th style="width:100px">账户余额(星币)</th>
      </tr>
    </thead>
    <tbody>
      <{foreach name=actor from=$actor_list item=actor}>
      <tr>
        <td><{$actor.actor_nick_name}></td>
        <td><{$actor.actor_currency}></td>
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
