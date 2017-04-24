<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">平台资料</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>平台名称 <span class="label label-important">不能重复</span></label>
        <input id="website_name" type="text" name="website_name" value="<{$website_data.website_name}>" class="input-xlarge" autofocus="true" required="true">
        <label>平台缩写 <span class="label label-important">不能重复</span></label>
        <input id="website_short_name" type="text" name="website_short_name" value="<{$website_data.website_short_name}>" class="input-xlarge" required="true">
        <label>备注</label>
        <textarea name="remark" rows="3" class="input-xlarge"><{$website_data.remark}></textarea>
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
