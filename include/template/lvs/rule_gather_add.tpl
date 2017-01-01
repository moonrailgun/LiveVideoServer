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
          <label>玩家编号(userid)</label>
          <input type="text" name="player_id" value="<{$_POST.player_id}>" class="input-xlarge" required="true" >
          <label>玩家姓名(username)</label>
          <input type="text" name="player_name" value="<{$_POST.player_name}>" class="input-xlarge" required="true" >
          <label>礼物类型(giftType)</label>
          <input type="text" name="gift_type" value="<{$_POST.gift_type}>" class="input-xlarge" required="true" >
          <label>礼物数量(giftAmount)</label>
          <input type="text" name="gift_amount" value="<{$_POST.gift_amount}>" class="input-xlarge" required="true" >
          <label>发送时间(sendTime)</label>
          <input type="text" name="send_time" value="<{$_POST.send_time}>" class="input-xlarge" required="true" >
          <label>主播编号(actorID)</label>
          <input type="text" name="actor_id" value="<{$_POST.actor_id}>" class="input-xlarge" required="true" >
          <label>主播姓名(actorName)</label>
          <input type="text" name="actor_name" value="<{$_POST.actor_name}>" class="input-xlarge" required="true" >
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
