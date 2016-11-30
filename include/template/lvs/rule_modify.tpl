<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">全局规则管理</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="" autocomplete="off">
          <label>acquisitionRule</label>
          <textarea name="acquisitionRule" row="3" class="input-xlarge"><{$acquisitionRuleValue}></textarea>
          <label>controllerDirectiveRule</label>
          <textarea name="controllerDirectiveRule" rows="3" class="input-xlarge"><{$controllerDirectiveRuleValue}></textarea>
          <label>costControlRule</label>
          <textarea name="costControlRule" rows="3" class="input-xlarge"><{$costControlRuleValue}></textarea>
          <label>gift2SenderInfoRule</label>
          <textarea name="gift2SenderInfoRule" rows="3" class="input-xlarge"><{$gift2SenderInfoRuleValue}></textarea>
          <label>tool2DirectiveRule</label>
          <textarea name="tool2DirectiveRule" rows="3" class="input-xlarge"><{$tool2DirectiveRuleValue}></textarea>
    			<div class="btn-toolbar">
    				<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
    				<div class="btn-group"></div>
    			</div>
			</form>
    </div>
    </div>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
