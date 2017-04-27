<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">道具信息</a></li>
  </ul>

	<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="" autocomplete="off">
        <label>组别</label>
        <select id="tool_type_id" name="tool_type_id" class="input-xlarge">
          <{html_options options=$item_group_id_list selected=$item_data.tool_type_id}>
        </select>
        <label>道具名称</label>
        <input id="tool_name" type="text" name="tool_name" value="<{$item_data.tool_name}>" class="input-xlarge" required="true">
        <label>道具指令</label>
        <input id="tool_direct" type="text" name="tool_direct" value="<{$item_data.tool_direct}>" class="input-xlarge" required="true">
        <label>标识</label>
        <select id="queue_flag" name="queue_flag" class="input-xlarge">
          <{html_options options=$queue_flag_list selected=$item_data.queue_flag}>
        </select>
        <div class="btn-toolbar">
          <button type="submit" class="btn btn-primary"><strong>提交</strong></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
