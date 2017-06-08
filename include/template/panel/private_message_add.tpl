<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">消息发布</a></li>
    </ul>
	<div id="myTabContent" class="tab-content">
	  <div class="tab-pane active in" id="home">
      <form id="tab" method="post" action="">
        <label>消息类型</label>
        <select id="message_type" name="message_type" class="input-xlarge">
          <{html_options options=$message_type_list selected=$_GET.message_type}>
        </select>
        <div id="message_to_block" style="display:none;">
          <label>发送给</label>
          <select id="message_to" name="message_to" class="input-xlarge">
            <{html_options values=$user_list output=$user_list selected=$_POST.message_to}>
          </select>
        </div>
				<label>消息内容</label>
				<textarea name="message_content" rows="5" class="input-xlarge"><{$_POST.message_content}></textarea>
				<div class="btn-toolbar">
					<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
				</div>
			</form>
    </div>
  </div>
</div>

<script>
$('#message_type').change(function(event) {
  if($(this).val() === "user") {
    $('#message_to_block').show();
  }else {
    $('#message_to_block').hide();
  }
});
</script>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
