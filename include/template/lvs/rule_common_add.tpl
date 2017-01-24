<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写规则信息</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="" autocomplete="off">
          <label>视频网站</label>
          <select id="website_id" name="website_id" class="input-xlarge">
            <{html_options options=$website_id_list selected=$_POST.website_id}>
          </select>
          <label>采数间隔</label>
          <input type="text" name="time_span" value="<{$_POST.time_span}>" class="input-xlarge" required="true" >
          <label>采数IP <span class="label label-info">多个IP用英文逗号[,]分割</span></label>
          <input type="text" name="web_ip" value="<{$_POST.web_ip}>" class="input-xlarge" required="true" >
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
