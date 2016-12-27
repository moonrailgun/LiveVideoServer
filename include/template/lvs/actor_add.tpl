<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写客户资料</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="" autocomplete="off">
          <label>客户昵称 <span class="label label-important">同一网站下不可重复</span></label>
          <input id="actor_nick_name" type="text" name="actor_nick_name" value="<{$_POST.actor_nick_name}>" class="input-xlarge" autofocus="true" required="true" onchange="updateGeneratedName()" onKeyUp="updateGeneratedName()">
          <label>客户联系电话</label>
          <input type="text" name="actor_phone" value="<{$_POST.actor_phone}>" class="input-xlarge" required="true">
          <label>客户真实姓名</label>
          <input type="text" name="actor_real_name" value="<{$_POST.actor_real_name}>" class="input-xlarge" required="true">
          <label>视频网站</label>
          <select id="website_id" name="website_id" class="input-xlarge" onchange="updateGeneratedName()" style="margin:5px 0px 0px">
            <{html_options options=$website_id_list selected=0}>
          </select>
          <label>将要生成的用户名</label>
          <input id="actor_generated_name" type="text" name="" class="input-xlarge" required="true" readonly="true">
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
    </script>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>
