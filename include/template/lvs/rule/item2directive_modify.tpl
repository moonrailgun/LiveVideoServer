<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">礼物信息</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>平台</label>
        <select id="website_id" name="website_id" class="input-xlarge">
          <{html_options options=$website_id_list selected=$data.website_id}>
        </select>
        <label>道具名称</label>
        <select id="tool_id" name="tool_id" class="input-xlarge">
          <{html_options options=$item_id_list selected=$data.tool_id}>
        </select>
        <label>指令地址</label>
        <input id="address" type="text" name="address" value="<{$data.address}>" class="input-xlarge" required="true">
        <label>命令</label>
        <input id="command" type="text" name="command" value="<{$data.command}>" class="input-xlarge" required="true">
        <label>参数</label>
        <input id="param" type="text" name="param" value="<{$data.param}>" class="input-xlarge" required="true">
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
