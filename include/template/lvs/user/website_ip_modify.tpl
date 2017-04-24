<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">平台IP</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>平台名称</label>
        <select id="website_id" name="website_id" class="input-xlarge">
          <{html_options options=$website_id_list selected=$website_ip_data.website_id}>
        </select>
        <label>平台IP <span class="label label-important">同一平台不能重复</span></label>
        <input id="website_ip" type="text" name="website_ip" value="<{$website_ip_data.website_ip}>" class="input-xlarge" required="true">
        <label>备注</label>
        <textarea name="remark" rows="3" class="input-xlarge"><{$website_ip_data.remark}></textarea>
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
