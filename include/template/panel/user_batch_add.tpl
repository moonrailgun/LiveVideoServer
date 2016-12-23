<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写账号资料</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="" autocomplete="off">
  				<label>用户ID前缀<span class="label label-info">英文</span></label>
  				<input type="text" name="user_id_prefix" value="<{$_POST.user_id_prefix}>" class="input-xlarge" autofocus="true" required="true" >
  				<label>用户ID编号保留数字位数<span class="label label-info">如保留三位数字则写3</span></label>
  				<input type="number" name="suffix_number" value="<{$_POST.suffix_number}>" class="input-xlarge" required="true" placeholder="3">
  				<label>起始编号</label>
  				<input type="number" name="start_num" value="<{$_POST.start_num}>" class="input-xlarge" required="true" placeholder="0">
  				<label>ID生成数</label>
  				<input type="number" name="count_num" value="<{$_POST.count_num}>" class="input-xlarge" required="true" placeholder="1">
  				<label>默认密码</label>
  				<input type="text" name="password" value="<{$_POST.password}>"  class="input-xlarge" required="true">
          <label>所属网站名</label>
  				<input type="text" name="website_name" value="<{$_POST.website_name}>"  class="input-xlarge" required="true" >
  				<label>用户描述</label>
  				<textarea name="user_desc" rows="3" class="input-xlarge"><{$_POST.user_desc}></textarea>
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
