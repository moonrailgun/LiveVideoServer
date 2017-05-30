<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">数据采集规则列表</a>
  <div id="page-stats" class="block-body collapse in">
    <form action="item_cost_modify.php" style="margin-top:20px;">
      <input type="text" class="input-xlarge" required="true" name="item_cost_value" value="<{$data}>" />
      <div class="btn-toolbar">
        <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        <div class="btn-group"></div>
      </div>
    </form>
  </div>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
