<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请修改规则信息</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="" autocomplete="off">
          <input type="hidden" name="website_id" value="<{$website_id}>">
  				<label>采数间隔</label>
  				<input type="text" name="time_span" value="<{$rule_info.time_span}>" class="input-xlarge" required="true">
          <label>采数IP <span class="label label-info">多个IP用英文逗号[,]分割</span></label>
  				<input type="text" name="web_ip" value="<{$rule_info.web_ip}>" class="input-xlarge" required="true">
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
