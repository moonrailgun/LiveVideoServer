<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请修改网站信息</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="" autocomplete="off">
          <input type="hidden" name="actor_id" value="<{$actor_id}>"></input>
          <label>客户昵称</label>
          <input id="actor_nick_name" type="text" name="actor_nick_name" value="<{$actor_info.actor_nick_name}>" class="input-xlarge" autofocus="true" required="true" onchange="updateGeneratedName()" onKeyUp="updateGeneratedName()">
          <label>客户联系电话</label>
          <input type="text" name="actor_phone" value="<{$actor_info.actor_phone}>" class="input-xlarge" required="true">
          <label>客户真实姓名</label>
          <input type="text" name="actor_real_name" value="<{$actor_info.actor_real_name}>" class="input-xlarge" required="true">
          <label>视频网站</label>
          <select id="website_id" name="website_id" class="input-xlarge" onchange="updateGeneratedName()" style="margin:5px 0px 0px">
            <{html_options options=$website_id_list selected=$website_id}>
          </select>
          <label>将要生成的用户名</label>
          <input id="actor_generated_name" type="text" name="" class="input-xlarge" readonly="true">
          <div class="btn-toolbar">
          	<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
          	<div class="btn-group"></div>
          </div>
  			</form>
      </div>
    </div>
    <script>
    function updateGeneratedName(){
      var nickName = $('#actor_nick_name').val();
      var websiteShortName = $('#website_id option:selected').text();
      websiteShortName = websiteShortName.split("(")[1];
      websiteShortName = websiteShortName.split(")")[0];
      console.log(websiteShortName);
      var generatedName = websiteShortName + nickName;

      $('#actor_generated_name').val(generatedName);
    }
    updateGeneratedName();
    </script>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
